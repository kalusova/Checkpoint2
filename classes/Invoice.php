<?php


class Invoice
{
    private $idNumInv;
    private $issueDate;
    private $state;


    /**
     * Customer constructor.
     * @param $idNumCust
     * @param $name
     * @param $surname
     * @param $login
     */
    public function __construct($idNumInv, $issueDate, $state){
        $this->idNumInv = $idNumInv;
        $this->issueDate = $issueDate;
        $this->state = $state;

    }

    /**
     * @return mixed
     */
    public function getIdNumInv()
    {
        return $this->idNumInv;
    }

    /**
     * @param mixed $idNumInv
     */
    public function setIdNumInv($idNumInv): void
    {
        $this->idNumInv = $idNumInv;
    }

    /**
     * @return mixed
     */
    public function getIssueDate()
    {
        return $this->issueDate;
    }

    /**
     * @param mixed $issueDate
     */
    public function setIssueDate($issueDate): void
    {
        $this->issueDate = $issueDate;
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



}