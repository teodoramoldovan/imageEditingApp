<?php


namespace ShareMyArt\Model\Validation\FormValidator;


use ShareMyArt\Model\Validation\Rule\DateInputValidator;
use ShareMyArt\Model\Validation\Rule\EmailInputValidator;
use ShareMyArt\Model\Validation\Rule\EmptyFileInputValidator;
use ShareMyArt\Model\Validation\Rule\PriceInputValidator;
use ShareMyArt\Request\Request;

class UploadProductFormValidator
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validateInput(array $userInsertedData): array
    {
        $errors = [];
        $baseFormValidator = new BaseFormValidator();
        $baseFormValidator->addValidationRule(new EmailInputValidator());
        $baseFormValidator->addValidationRule(new DateInputValidator());
        $baseFormValidator->addValidationRule(new PriceInputValidator());
        $baseFormValidator->addValidationRule(new EmptyFileInputValidator($this->request));

        $errors = $baseFormValidator->runValidationRules($userInsertedData);


        return array_filter($errors);
    }

}