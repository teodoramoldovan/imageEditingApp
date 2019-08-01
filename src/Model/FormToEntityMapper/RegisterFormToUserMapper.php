<?php


namespace ShareMyArt\Model\FormToEntityMapper;


use ShareMyArt\Model\DomainObject\User;
use ShareMyArt\Request\Request;

class RegisterFormToUserMapper
{
    /**
     * @var Request
     */
    private $request;

    /**
     * RegisterFormToUserMapper constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Will return  a user object from the register form data
     *
     * @return User|null
     */
    public function getUser(): ?User
    {
        if (!$this->request->getPostData(null)) {
            return null;
        }

        return new User(
            $this->request->getPostData('name'),
            $this->request->getPostData('email'),
            $this->request->getPostData('password')
        );
    }

}