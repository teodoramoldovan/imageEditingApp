<?php


namespace ShareMyArt\Model\Persistence\Finder;

use PDO;
use ShareMyArt\Model\DomainObject\User;

class UserFinder extends AbstractFinder
{
    /**
     * @param int $id
     * @return User|null
     */
    public function findUserById(int $id): ?User
    {

        $sql = "select * from share_my_art.user where id=?";

        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return ($row === false) ? null : $this->translateToUserWithoutPassword($row);
    }

    /**
     * Will return a user with a null password
     * for places when password is not required for verification
     *
     * @param array|null $row
     * @return User
     */
    private function translateToUserWithoutPassword(?array $row): User
    {
        $user = new User($row['name'], $row['email'], null, $row['id']);

        return $user;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findUserByEmail(string $email): ?User
    {
        $sql = "select * from share_my_art.user where email=?";

        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $email, PDO::PARAM_STR);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return ($row === false) ? null : $this->translateToUser($row);

    }

    /**
     * Will return a user with all fields not null
     * to be used at log in
     *
     * @param array|null $row
     * @return User
     */
    private function translateToUser(?array $row): User
    {
        $user = (!empty($row)) ? new User($row['name'], $row['email'], $row['password'], $row['id']) : null;

        return $user;
    }
}