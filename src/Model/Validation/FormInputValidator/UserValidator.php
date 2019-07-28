<?php


namespace ShareMyArt\Model\Validation\FormInputValidator;


use ShareMyArt\Model\DomainObject\User;

class UserValidator
{
    public function validateUserAtLogin(?User $user):array
    {
        $errors=[];
        if(empty($user)){
            $errors['userNotFoundError']='User not found in the database';
            return $errors;
        }
        if($user->getPassword()!=$_POST['password']){
            $errors['invalidPasswordError']='Invalid password';
        }
        return $errors;

    }

    public function validateUserAtRegistration(?User $user):array
    {
        $errors=[];
        if(!empty($user)){
            $errors['userAlreadyExistsError']='An user with this email already exists';

        }
        return $errors;
    }

}