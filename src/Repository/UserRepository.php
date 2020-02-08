<?php


namespace Wog\Repository;

use PDO;
use Wog\Database\Manager;
use Wog\Model\UserModel;

class UserRepository
{

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param UserModel $user
     *
     * @throws \PDOException for user exists or errors
     */
    public function insert(UserModel $user)
    {
        $dbh = Manager::getConnection();

        $sth = $dbh->prepare(
            "INSERT INTO"
            . " users(email, password, surname, first_name, last_name, phone, adress, city, zip, token) "
            . " VALUES (:email, :password, :surname, :firstName, :lastName, :phone, :adress, :city, :zip, :token)"
        );

        $sth->bindValue(":email", $user->getEmail());
        $sth->bindValue(":password", $user->getPassword());
        $sth->bindValue(":surname", $user->getSurname());
        $sth->bindValue(":firstName", $user->getFirstName());
        $sth->bindValue(":lastName", $user->getLastName());
        $sth->bindValue(":phone", $user->getPhone());
        $sth->bindValue(":adress", $user->getAdress());
        $sth->bindValue(":city", $user->getCity());
        $sth->bindValue(":zip", $user->getZip());
        $sth->bindValue(":token", $user->getToken());

        $sth->execute();

    }

    /**
     * @return array of UserModel
     */
    public function select(): array
    {
        $dbh = Manager::getConnection();

        $sth = $dbh->prepare("SELECT * FROM users");
        $sth->setFetchMode(PDO::FETCH_CLASS, UserModel::class);
        $sth->execute();
        return $sth->fetchAll();
    }

    /**
     * @param int $id
     * @return UserModel
     */
    public function selectOne(int $id): UserModel
    {
        $dbh = Manager::getConnection();

        $sth = $dbh->prepare("SELECT * FROM users WHERE id = :id");
        $sth->bindValue(":id", $id);
        $sth->setFetchMode(PDO::FETCH_CLASS, UserModel::class);
        $sth->execute();
        return $sth->fetch();
    }


    /**
     * @param string $userMail
     * @return UserModel
     */
    public function selectByEmail(string $userMail): UserModel
    {
        $dbh = Manager::getConnection();
        $sth = $dbh->prepare(
            "SELECT *"
            . " FROM users "
            . " WHERE email = :email"
        );
        $sth->setFetchMode(PDO::FETCH_CLASS, UserModel::class);
        $sth->bindValue(":email", $userMail);
        $sth->execute();
        return $sth->fetch(); //renvoie un bool
//        return $sth->fetchAll(); // aurait pu marcher mais renvoi un tableau
    }

    /**
     * @param int $id
     * @param string $token
     *
     * @return UserModel
     *
     * @throws \TypeError
     */
    public function deleteOne(int $id, string $token): UserModel
    {
        $user = $this->selectOne($id);

        $sth = Manager::getConnection()->prepare("DELETE FROM users WHERE id = :id AND token = :token");
        $sth->bindValue(":id", $id);
        $sth->bindValue(":token", $token);
        $sth->execute();

        if ($sth->rowCount()){
            return $user;
        }


//        $sth->setFetchMode(PDO::FETCH_CLASS, UserModel::class);
//
//        return $sth->fetch();
    }

}