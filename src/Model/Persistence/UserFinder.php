<?php

namespace ShareMyArt\Model\Persistence;

use ShareMyArt\Model\DomainObject\User;

class UserFinder
{
    //TODO rewrite when database exists
    private $users=[
        ['id'=>1,
        'name'=>'Ion Gheorghe',
      'email'=>'ion@gheorghe.com',
      'password'=>'parola'],
        
    ];

    public function findUserByEmail(string $email){
        foreach ($this->users as $user){
            if($email===$user['email']){
                return new User($user['name'],$user['email'],$user['password'],$user['id']);
            }
        }
        
        return null;
    }

    public function addUser(array $newUser):User
    {
        $lastUser=end($this->users);
        $key=$lastUser['id']+1;
        array_unshift($newUser,['id'=>$key]);
        $this->users=array_merge($this->users,$newUser);

        return new User($newUser['name'],$newUser['email'],$newUser['password'],$key);
    }

}