<?php


namespace ShareMyArt\Model\Validation\FormValidator;


use ShareMyArt\Model\Validation\Rule\DateInputValidator;
use ShareMyArt\Model\Validation\Rule\EmailInputValidator;
use ShareMyArt\Model\Validation\Rule\PriceInputValidator;

class UploadProductFormValidator
{
    public function validateInput(array $userInsertedData): array
    {
        $errors = [];
        $baseFormValidator = new BaseFormValidator();
        $baseFormValidator->addValidationRule(new EmailInputValidator());
        $baseFormValidator->addValidationRule(new DateInputValidator());
        $baseFormValidator->addValidationRule(new PriceInputValidator());

        $errors = $baseFormValidator->runValidationRules($userInsertedData);


        return array_filter($errors);
    }

}