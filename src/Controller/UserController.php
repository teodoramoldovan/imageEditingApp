<?php


namespace ShareMyArt\Controller;


use ShareMyArt\Model\DomainObject\User;
use ShareMyArt\Model\FormToEntityMapper\RegisterFormToUserMapper;
use ShareMyArt\Model\Persistence\Finder\UserFinder;
use ShareMyArt\Model\Persistence\Mapper\UserMapper;
use ShareMyArt\Model\Persistence\PersistenceFactory;
use ShareMyArt\Model\Validation\FormInputValidator\UserValidator;
use ShareMyArt\Model\Validation\FormValidator\LoginFormValidator;
use ShareMyArt\Model\Validation\FormValidator\RegisterFormValidator;
use ShareMyArt\View\Renderer\LoginPageRenderer;
use ShareMyArt\View\Renderer\OrdersPageRenderer;
use ShareMyArt\View\Renderer\RegisterPageRenderer;
use ShareMyArt\View\Renderer\UploadsPageRenderer;

class UserController extends AbstractController
{

    /**
     * Will display the login page
     */
    public function login(): void
    {
        $errors = [];
        $loginPageRenderer = new LoginPageRenderer($this->request, $errors);
        $loginPageRenderer->render();
    }

    /**
     * Will process the information entered by user in the login form
     */
    public function loginPost(): void
    {
        //check errors in form
        $loginFormValidator = new LoginFormValidator();
        $errors = $loginFormValidator->validateInput($this->request->getPostData(null));

        $userValidationErrors = [];

        if (empty($errors)) {

            /** @var UserFinder $userFinder */
            $userFinder = PersistenceFactory::createFinder(User::class);
            $user = $userFinder->findUserByEmail($this->request->getPostData('email'));

            //check if the user does not exist in the database or if the password in invalid
            $userValidator = new UserValidator($this->request);
            $userValidationErrors = $userValidator->validateUserAtLogin($user);
        }

        $errors = array_merge($userValidationErrors, $errors);

        if (empty($errors)) {
            //if there are no problems, continue with logging in the user
            //keep the id in his session
            $this->request->setSessionData('userId', $user->getId());

            header('Location:/');
        }

        //if there are errors and the user cannot be logged in, display them
        //in the login page
        $loginPageRenderer = new LoginPageRenderer($this->request, $errors);
        $loginPageRenderer->render();

    }


    /**
     * Will remove the user's id from the session, meaning the user will
     * no longer be logged in
     */
    public function logout(): void
    {
        $this->request->unsetSessionData('userId');

        header('Location:/');
    }

    /**
     * Will display the registration page
     */
    public function register(): void
    {
        $errors = [];
        $registerPageRenderer = new RegisterPageRenderer($this->request, $errors);
        $registerPageRenderer->render();
    }

    /**
     * Will register(insert the use in the database) if there are no errors
     * in the data inserted by the user
     */
    public function registerPost(): void
    {
        //validate that the form input is correct
        $registerFormValidator = new RegisterFormValidator();
        $errors = $registerFormValidator->validateInput($this->request->getPostData(null));

        $userValidationErrors = [];

        if (empty($errors)) {

            /** @var UserFinder $userFinder */
            $userFinder = PersistenceFactory::createFinder(User::class);
            $user = $userFinder->findUserByEmail($this->request->getPostData('email'));

            //verify if the user does not already exist in the database
            $userValidator = new UserValidator($this->request);
            $userValidationErrors = $userValidator->validateUserAtRegistration($user);
        }

        $errors = array_merge($userValidationErrors, $errors);

        if (empty($errors)) {

            //convert form data into an user object
            $registerFormMapper = new RegisterFormToUserMapper($this->request);
            $newUser = $registerFormMapper->getUser();

            /** @var UserMapper $userMapper */
            $userMapper = PersistenceFactory::createMapper(User::class);
            $userMapper->save($newUser);

            //after the registration the user will be automatically logged in
            $this->request->setSessionData('userId', $newUser->getId());

            header('Location:/');
        }

        //if any errors occur, they will be displayed in the form page
        //without the registration going through
        $registerPageRenderer = new RegisterPageRenderer($this->request, $errors);
        $registerPageRenderer->render();

    }

    public function showUploads()
    {
        //TODO

        $uploadsPageRenderer = new UploadsPageRenderer($this->request);
        $uploadsPageRenderer->render();
    }

    public function showOrders()
    {
        //TODO
        $ordersPageRenderer = new OrdersPageRenderer($this->request);
        $ordersPageRenderer->render();

    }
}