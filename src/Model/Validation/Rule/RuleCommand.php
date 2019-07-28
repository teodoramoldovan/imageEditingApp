<?php


namespace ShareMyArt\Model\Validation\Rule;


abstract class RuleCommand
{
    abstract public function validate(array $userInsertedData):array;
}