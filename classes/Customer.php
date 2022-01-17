<?php


class Customer
{
    private $idNumCust;
    private $name;
    private $surname;
    private $login;
    private $email;

    /**
     * Customer constructor.
     * @param $idNumCust
     * @param $name
     * @param $surname
     * @param $login
     */
    public function __construct($idNumCust, $name, $surname, $login, $email){
        $this->idNumCust = $idNumCust;
        $this->name = $name;
        $this->surname = $surname;
        $this->login = $login;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getIdNumCust()
    {
        return $this->idNumCust;
    }

    /**
     * @param mixed $idNumCust
     */
    public function setIdNumCust($idNumCust): void
    {
        $this->idNumCust = $idNumCust;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }/**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }
}