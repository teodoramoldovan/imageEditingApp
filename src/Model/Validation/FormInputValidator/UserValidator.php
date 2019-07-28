<?php


namespace ShareMyArt\Model\Validation\FormInputValidator;


use ShareMyArt\Model\DomainObject\User;

class UserValidator
{
    public function validateUser(?User $user):array
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

}