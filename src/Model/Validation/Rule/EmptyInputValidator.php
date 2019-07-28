<?php


namespace ShareMyArt\Model\Validation\Rule;


class EmptyInputValidator extends RuleCommand
{
    public function validate(array $userInsertedData):array
    {
        foreach ($userInsertedData as $inputValue){
            if(empty($inputValue)){
                return ['emptyFieldsError'=>'Input fields cannot be empty'];
            }
        }
        return [];
    }
}