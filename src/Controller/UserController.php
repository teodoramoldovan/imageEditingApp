<?php


namespace ShareMyArt\Controller;


use ShareMyArt\Model\Persistence\UserFinder;
use ShareMyArt\Model\Validation\FormInputValidator\UserValidator;
use ShareMyArt\Model\Validation\FormValidator\LoginFormValidator;
use ShareMyArt\Model\Validation\FormValidator\RegisterFormValidator;
use ShareMyArt\SuperGlobalsWrapper\PostSuperGlobalWrapper;
use ShareMyArt\SuperGlobalsWrapper\SessionSuperGlobalWrapper;
use ShareMyArt\View\Renderer\LoginPageRenderer;
use ShareMyArt\View\Renderer\ProfilePageRenderer;
use ShareMyArt\View\Renderer\RegisterPageRenderer;

class UserController
{
    private $postDataWrapper;
    private $sessionDataWrapper;

    public function __construct()
    {
        $this->postDataWrapper = new PostSuperGlobalWrapper();
        $this->sessionDataWrapper = new SessionSuperGlobalWrapper();
    }

    /**
     * Will display the login page
     */
    public function login()
    {
        $errors = [];
        $loginPageRenderer = new LoginPageRenderer($errors);
        $loginPageRenderer->render();
    }

    /**
     * Will process the information entered by user in the login form
     */
    public function loginPost()
    {
        $loginFormValidator = new LoginFormValidator();
        $errors = $loginFormValidator->validateInput($this->postDataWrapper->getPostSuperGlobalData());

        $userFinder = new UserFinder();
        $user = $userFinder->findUserByEmail($this->postDataWrapper->getPostSuperGlobalData()['email']);

        $userValidator = new UserValidator();
        $userValidationErrors = $userValidator->validateUserAtLogin($user);

        $errors = array_merge($userValidationErrors, $errors);
        if (empty($errors)) {
            $this->sessionDataWrapper->setSessionSuperGlobal('userId', $user->getId());

            header('Location:/user/profile');
        }

        $loginPageRenderer = new LoginPageRenderer($errors);
        $loginPageRenderer->render();

    }

    /**
     * Will display the profile of the currently logged in user
     */
    public function showProfile()
    {
        $profilePageRenderer = new ProfilePageRenderer();
        $profilePageRenderer->render();
    }

    public function logout()
    {
        $this->sessionDataWrapper->unsetSessionValue('userId');

        header('Location:/');
    }

    public function register()
    {
        $errors = [];
        $registerPageRenderer = new RegisterPageRenderer($errors);
        $registerPageRenderer->render();
    }

    public function registerPost()
    {

        $registerFormValidator = new RegisterFormValidator();
        $errors = $registerFormValidator->validateInput($this->postDataWrapper->getPostSuperGlobalData());

        $userFinder = new UserFinder();
        $user = $userFinder->findUserByEmail($this->postDataWrapper->getPostSuperGlobalData()['email']);

        $userValidator = new UserValidator();
        $userValidationErrors = $userValidator->validateUserAtRegistration($user);

        $errors = array_merge($userValidationErrors, $errors);

        if (empty($errors)) {
            $newUser = $userFinder->addUser(['name' => $_POST['name'], 'email' => $_POST['email'], 'password' => $_POST['password']]);
            $this->sessionDataWrapper->setSessionSuperGlobal('userId', $newUser->getId());

            header('Location:/user/profile');
        }

        $registerPageRenderer = new RegisterPageRenderer($errors);
        $registerPageRenderer->render();

    }

}