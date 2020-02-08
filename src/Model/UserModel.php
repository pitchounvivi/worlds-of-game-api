<?php


namespace Wog\Model;


class UserModel implements \JsonSerializable
{
    private
        /**
         * @var string
         */
        $email,
        /**
         * @var string
         */
        $password,
        /**
         * @var string
         */
        $surname,
        /**
         * @var string
         */
        $firstName,
        /**
         * @var string
         */
        $lastName,
        /**
         * @var string
         */
        $phone,
        /**
         * @var string
         */
        $adress,
        /**
         * @var string
         */
        $city,
        /**
         * @var string
         */
        $zip,
        /**
         * @var string
         */
        $token;

    /**
     * UserModel constructor.
     * @param $email : string
     * @param $password : string
     * @param $phone : string
     * @param $surname : string
     * @param $lastName : string
     * @param $firstName : string
     * @param $adress : string
     * @param $city : string
     * @param $zip : string
     * @param $token : string
     */
    public function __construct(\stdClass $data = null)
    {
        if(null===$data){// si paramètre null on passe au suivant
            return;
        }
        foreach ($this as $key => $value){
            if (property_exists($data, $key)) {
                $this->$key = $data->$key; //exemple de lecture this->phone = data->phone
//                var_dump($key);
//                var_dump($value);
            }
        }
    }

    /**
     * @return string le ? signifie que le type de retour peut être null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */


    /**
     * @param string $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getAdress(): ?string
    {
        return $this->adress;
    }

    /**
     * @param string $adress
     */
    public function setAdress($adress): void
    {
        $this->adress = $adress;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip): void
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.

        //pour gérer le problème retour dans la réponse à cause des noms de colonnes différents
        //on utilise une ternaire car il y a dans la réponse de retour : first_name et firstName

        return [
            "email" => $this->email,
            "surname"=> $this->surname,
            "firstName"=> property_exists($this,"first_name") ? $this->first_name : $this->firstName,
            "lastName"=> property_exists($this,"last_name") ? $this->last_name : $this->lastName,
            "phone"=> $this->phone,
            "adress"=> $this->adress,
            "city"=> $this->city,
            "zip"=> $this->zip//,
            //"token"=> $this->token //on dégage le token pour qu'il ne soit plus affiché dans la réponse
        ];


//        //on peut éviter la ternaire
//        on utilise un tableau
//    $tab = [
//        "email"=>$this->email,
//        ...
//    ];
//        ...
//        if (array_key_exists("first_name")){
//            $this->first_name;
//        } else {
//            $this->firstName
//        }
//        ...
//
    }
}