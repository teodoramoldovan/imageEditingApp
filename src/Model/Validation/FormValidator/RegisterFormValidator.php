<?php


namespace ShareMyArt\Model\Validation\FormValidator;


use ShareMyArt\Model\Validation\Rule\EmailInputValidator;
use ShareMyArt\Model\Validation\Rule\PasswordConfirmationMatchValidator;

class RegisterFormValidator
{
    public function validateInput(array $userInsertedData):array
    {
        $errors=[];
        $baseFormValidator=new BaseFormValidator();
        $baseFormValidator->addValidationRule(new EmailInputValidator());
        $baseFormValidator->addValidationRule(new PasswordConfirmationMatchValidator());

        $errors=$baseFormValidator->runValidationRules($userInsertedData);

        return array_filter($errors);
    }

}