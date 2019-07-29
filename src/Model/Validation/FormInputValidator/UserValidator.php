<?php


namespace ShareMyArt\Model\Validation\FormInputValidator;


use ShareMyArt\Model\DomainObject\User;
use ShareMyArt\Request\Request;

class UserValidator
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    public function validateUserAtLogin(?User $user): array
    {
        $errors = [];
        if (empty($user)) {
            $errors['userNotFoundError'] = 'User not found in the database';
            return $errors;
        }
        if ($user->getPassword() != $this->request->getPostData('password')) {
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