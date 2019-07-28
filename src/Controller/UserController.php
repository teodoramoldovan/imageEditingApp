<?php


namespace ShareMyArt\Controller;


use ShareMyArt\Model\Persistence\UserFinder;
use ShareMyArt\Model\Validation\FormInputValidator\UserValidator;
use ShareMyArt\Model\Validation\FormValidator\LoginFormValidator;
use ShareMyArt\View\Renderer\LoginPageRenderer;
use ShareMyArt\View\Renderer\ProfilePageRenderer;

class UserController
{

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
        $errors = $loginFormValidator->validateInput($_POST);

        $userFinder = new UserFinder();
        $user = $userFinder->findUserByEmail($_POST['email']);

        $userValidator = new UserValidator();
        $userValidationErrors = $userValidator->validateUser($user);

        $errors = array_merge($userValidationErrors, $errors);

        if (empty($errors)) {
            $_SESSION['userId'] = $user->getId();
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
        unset($_SESSION['userId']);

        header('Location:/');
    }

}