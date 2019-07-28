<?php

namespace ShareMyArt\Model\Persistence;

use ShareMyArt\Model\DomainObject\User;

class UserFinder
{
    const USER=[
        'id'=>1,
        'name'=>'Ion Gheorghe',
      'email'=>'ion@gheorghe.com',
      'password'=>'parola',
    ];

    public function findUserByEmail(string $email){
        if($email===self::USER['email']){
            return new User(self::USER['name'],self::USER['email'],self::USER['password'],self::USER['id']);
        }
        return null;
    }

}