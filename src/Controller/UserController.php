<?php


namespace ShareMyArt\Controller;


use ShareMyArt\Model\Persistence\UserFinder;
use ShareMyArt\Model\Validation\FormInputValidator\UserValidator;
use ShareMyArt\Model\Validation\FormValidator\LoginFormValidator;
use ShareMyArt\Model\Validation\FormValidator\RegisterFormValidator;
use ShareMyArt\View\Renderer\LoginPageRenderer;
use ShareMyArt\View\Renderer\ProfilePageRenderer;
use ShareMyArt\View\Renderer\RegisterPageRenderer;

class UserController extends AbstractController
{

    /**
     * Will display the login page
     */
    public function login()
    {
        $errors = [];
        $loginPageRenderer = new LoginPageRenderer($this->request,$errors);
        $loginPageRenderer->render();
    }

    /**
     * Will process the information entered by user in the login form
     */
    public function loginPost()
    {
        $loginFormValidator = new LoginFormValidator();
        $errors = $loginFormValidator->validateInput($this->request->getPostData(null));

        $userFinder = new UserFinder();
        $user = $userFinder->findUserByEmail($this->request->getPostData('email'));

        $userValidator = new UserValidator($this->request);
        $userValidationErrors = $userValidator->validateUserAtLogin($user);

        $errors = array_merge($userValidationErrors, $errors);
        if (empty($errors)) {
            $this->request->setSessionData('userId', $user->getId());

            header('Location:/user/profile');
        }

        $loginPageRenderer = new LoginPageRenderer($this->request, $errors);
        $loginPageRenderer->render();

    }

    /**
     * Will display the profile of the currently logged in user
     */
    public function showProfile()
    {
        $profilePageRenderer = new ProfilePageRenderer($this->request);
        $profilePageRenderer->render();
    }

    public function logout()
    {
        $this->request->unsetSessionData('userId');

        header('Location:/');
    }

    public function register()
    {
        $errors = [];
        $registerPageRenderer = new RegisterPageRenderer($this->request,$errors);
        $registerPageRenderer->render();
    }

    public function registerPost()
    {

        $registerFormValidator = new RegisterFormValidator();
        $errors = $registerFormValidator->validateInput($this->request->getPostData(null));

        $userFinder = new UserFinder();
        $user = $userFinder->findUserByEmail($this->request->getPostData('email'));

        $userValidator = new UserValidator($this->request);
        $userValidationErrors = $userValidator->validateUserAtRegistration($user);

        $errors = array_merge($userValidationErrors, $errors);

        if (empty($errors)) {
            $newUser = $userFinder->addUser(['name' => $_POST['name'], 'email' => $_POST['email'], 'password' => $_POST['password']]);
            $this->request->setSessionData('userId', $newUser->getId());

            header('Location:/user/profile');
        }

        $registerPageRenderer = new RegisterPageRenderer($this->request,$errors);
        $registerPageRenderer->render();

    }
}