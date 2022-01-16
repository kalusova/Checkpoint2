<?php
declare(strict_types=1);

class Order
{
    private $idNumOrder;
    private $login;
    private $accDate;
    private $sendDate;
    private $state;
    private $invoiceNum;
    private $idNumCust;
    private $name;
    private $surname;


    /**
     * Order constructor.
     * @param $idNumOrder
     * @param $login
     * @param $accDate
     * @param $sendDate
     * @param $state
     * @param $invoiceNum
     * @param $idNumCust
     * @param $name
     * @param $surname
     */
    public function __construct($idNumOrder, $login, $accDate, $sendDate, $state, $invoiceNum, $idNumCust, $name, $surname)
    {
        $this->idNumOrder = $idNumOrder;
        $this->login = $login;
        $this->accDate = $accDate;
        $this->sendDate = $sendDate;
        $this->state = $state;
        $this->invoiceNum = $invoiceNum;
        $this->idNumCust = $idNumCust;
        $this->name = $name;
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getIdNumOrder()
    {
        return $this->idNumOrder;
    }

    /**
     * @param mixed $idNumOrder
     */
    public function setIdNumOrder($idNumOrder): void
    {
        $this->idNumOrder = $idNumOrder;
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
    public function getAccDate()
    {
        return $this->accDate;
    }

    /**
     * @param mixed $accDate
     */
    public function setAccDate($accDate): void
    {
        $this->accDate = $accDate;
    }

    /**
     * @return mixed
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * @param mixed $sendDate
     */
    public function setSendDate($sendDate): void
    {
        $this->sendDate = $sendDate;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state): void
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getInvoiceNum()
    {
        return $this->invoiceNum;
    }

    /**
     * @param mixed $invoiceNum
     */
    public function setInvoiceNum($invoiceNum): void
    {
        $this->invoiceNum = $invoiceNum;
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




}
?>