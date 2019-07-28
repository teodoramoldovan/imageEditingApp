<?php


namespace ShareMyArt\Model\Validation\Rule;


class EmailInputValidator extends RuleCommand
{
    public function validate(array $userInsertedData): string
    {
        if(!filter_var($userInsertedData['email'], FILTER_VALIDATE_EMAIL)){
            return 'Invalid email format';
        }
        return '';
    }
}