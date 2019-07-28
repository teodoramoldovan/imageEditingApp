<?php


namespace ShareMyArt\Model\Validation\Rule;


class PasswordConfirmationMatchValidator extends RuleCommand
{

    public function validate(array $userInsertedData): array
    {
        if($userInsertedData['password']!==$userInsertedData['passwordConfirmation']){
            return ['passwordMatchError'=>'Confirmation password does not match'];
        }

        return [];
    }
}