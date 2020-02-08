<?php


namespace Wog\Database;


class Manager
{

    private static
        /**
         * @var \PDO
         */
        $connection;

    /**
     * Manager constructor.
     */
    public function __construct()
    {
        //les chemins absolut le sont toujours par rapport à index.php
        //$json = file_get_contents(__DIR__ . "/../../config/database.json");
        //var_dump($json); //pour trouver le chemin

        $config = json_decode(file_get_contents(__DIR__ . "/../../config/database.json"));

        Manager::$connection = new \PDO(
            "$config->driver:dbname=$config->database;host=$config->host;port=$config->port;charset=$config->charset",
            $config->user,
            $config->password,
            [ //en ajoutant le tableau, on le déclare en mode strict pour gérer les erreurs
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    /**
     * @return \PDO
     */
    public static function getConnection(): \PDO
    {
        if (!Manager::$connection) {
            new Manager();
        }
        return Manager::$connection; //peut se remplacer par SELF::$connection
    }

}