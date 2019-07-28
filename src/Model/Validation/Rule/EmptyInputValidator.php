<?php


namespace ShareMyArt\Model\Validation\Rule;


class EmptyInputValidator extends RuleCommand
{
    public function validate(array $userInsertedData):string
    {
        if(empty($userInsertedData['email']) || empty($userInsertedData['password'])){
            return 'Input fields cannot be empty';
        }
        return '';
    }
}