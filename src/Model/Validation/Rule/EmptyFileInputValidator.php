<?php


namespace ShareMyArt\Model\Validation\Rule;


use ShareMyArt\Request\Request;

class EmptyFileInputValidator extends RuleCommand
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate(array $userInsertedData): array
    {
        if ('' === $this->request->getFiles('image','name')) {
           return ['noFileUploadedError'=>'You must upload a file'];
        }

        return [];
    }
}