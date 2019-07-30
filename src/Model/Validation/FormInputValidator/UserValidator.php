<?php


namespace ShareMyArt\Model\Validation\FormInputValidator;


use ShareMyArt\Model\DomainObject\User;
use ShareMyArt\Request\Request;

class UserValidator
{
    /**
     * @var Request $request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Will be used to verify if the login data is correct,
     * meaning that the user exists in the database and that the password is correct
     *
     * @param User|null $user
     * @return array
     */
    public function validateUserAtLogin(?User $user): array
    {
        $errors = [];
        if (empty($user)) {
            $errors['userNotFoundError'] = 'User not found in the database';
            return $errors;
        }

        if (!password_verify($this->request->getPostData('password'), $user->getPassword())) {
            $errors['invalidPasswordError'] = 'Invalid password';
        }
        return $errors;

    }

    /**
     * Will check is a user already exists in the database
     * in order to avoid double registration
     *
     * @param User|null $user
     * @return array
     */
    public function validateUserAtRegistration(?User $user): array
    {
        $errors = [];
        if (!empty($user)) {
            $errors['userAlreadyExistsError'] = 'An user with this email already exists';

        }
        return $errors;
    }

}