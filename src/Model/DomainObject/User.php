<?php

namespace ShareMyArt\Model\DomainObject;
class User
{
    /** @var int $id */
    private $id;
    /** @var string $name */
    private $name;
    /** @var string $email */
    private $email;
    /** @var string $password */
    private $password;

    /**
     * User constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(string $name, string $email, string $password, int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    //TODO getters and setters when needed


    //TODO
    public function getOrders()
    {

    }

    //TODO
    public function getProducts()
    {

    }


}