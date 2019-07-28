<?php


namespace ShareMyArt\Model\Validation\FormValidator;


use ShareMyArt\Model\Validation\Rule\EmailInputValidator;

class LoginFormValidator
{

    public function validateInput(array $userInsertedData):array
    {
        $errors=[];
        $baseFormValidator=new BaseFormValidator();
        $baseFormValidator->addValidationRule(new EmailInputValidator());

        $errors=$baseFormValidator->runValidationRules($userInsertedData);
        return array_filter($errors);
    }


}