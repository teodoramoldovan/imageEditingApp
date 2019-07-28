<?php


namespace ShareMyArt\Model\Validation\FormValidator;

use ShareMyArt\Model\Validation\Rule\EmptyInputValidator;
use ShareMyArt\Model\Validation\Rule\RuleCommand;

class BaseFormValidator
{
    /**
     * @var RuleCommand[]
     */
    private $validationRules;


    /**
     * BaseFormValidator constructor.
     */
    public function __construct()
    {
        $this->validationRules[] = new EmptyInputValidator();
    }

    public function addValidationRule(RuleCommand $ruleCommand)
    {
        $this->validationRules[]=$ruleCommand;
    }

    public function runValidationRules(array $userInsertedData):array
    {
        $errors=[];
        foreach ($this->validationRules as $rule){
            $errors=array_merge($errors,$rule->validate($userInsertedData));
        }
        return $errors;
    }

}