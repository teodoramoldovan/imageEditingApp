<?php


namespace ShareMyArt\Model\Validation\FormInputValidator;


use ShareMyArt\Model\DomainObject\User;
use ShareMyArt\SuperGlobalsWrapper\PostSuperGlobalWrapper;


class UserValidator
{
    private $postDataWrapper;

    public function __construct()
    {
        $this->postDataWrapper = new PostSuperGlobalWrapper();
    }

    public function validateUserAtLogin(?User $user): array
    {
        $errors = [];
        if (empty($user)) {
            $errors['userNotFoundError'] = 'User not found in the database';
            return $errors;
        }
        if ($user->getPassword() != $this->postDataWrapper->getPostSuperGlobalData()['password']) {
            $errors['invalidPasswordError'] = 'Invalid password';
        }
        return $errors;

    }

    public function validateUserAtRegistration(?User $user): array
    {
        $errors = [];
        if (!empty($user)) {
            $errors['userAlreadyExistsError'] = 'An user with this email already exists';

        }
        return $errors;
    }

}