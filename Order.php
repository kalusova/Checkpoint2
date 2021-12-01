<?php
declare(strict_types=1);

class Order
{
    public $id;
    public $name;
    public $surname;
    public $start;
    public $end;
    public $state;

    /**
     * Order constructor.
     * @param $id
     * @param $name
     * @param $surname
     * @param $start
     * @param $end
     * @param $state
     */
    public function __construct($id, $name, $surname, $start, $end, $state)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->start = $start;
        $this->end = $end;
        $this->state = $state;
    }

    /** GETTERS and SETTERS */
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function setName($name)
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
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
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
    public function setState($state)
    {
        $this->state = $state;
    }
}
?>