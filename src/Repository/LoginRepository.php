<?php


namespace Wog\Repository;

use PDO;
use Wog\Controller\Api\LoginController;
use Wog\Database\Manager;
use Wog\Model\UserModel;

class LoginRepository
{
    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $userMail
     * @param $userPassword
     * @return array
     */
    public function verifyLogin($userMail, $userPassword)
    {
        $dbh = Manager::getConnection();
        $sth = $dbh->prepare(
            "SELECT *"
            . " FROM users "
            . " WHERE email = :email AND password = :password"
        );
        $sth->setFetchMode(PDO::FETCH_CLASS, UserModel::class);
        $sth->bindValue(":email", $userMail);
        $sth->bindValue(":password", $userPassword);
        $sth->execute();
//        var_dump($sth->fetch());
//        exit();
        return $sth->fetch();
    }
}