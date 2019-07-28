<?php


namespace ShareMyArt\Model\Validation\Rule;


class EmailInputValidator extends RuleCommand
{
    public function validate(array $userInsertedData): array
    {
        if(!filter_var($userInsertedData['email'], FILTER_VALIDATE_EMAIL)){
            return ['invalidEmailFormatError'=>'Invalid email format'];
        }
        return [];
    }
}