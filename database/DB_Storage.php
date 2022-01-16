<?php
declare(strict_types=1);
include "../classes/Order.php";

class DB_Storage
{
    public $mysqli;

    /**
     * DB_Storage constructor.
     * @param mysqli $mysqli
     */
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    /**
     * @return Order[]
     */
    public function getAll() : array {
        $query = "SELECT * FROM eshopOrder o join customer c on c.login = o.login";
        $orders = [];
        if($result = $this->mysqli->query($query)){
            while($row = $result->fetch_row() ){
                $order = new Order($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
                $orders[] = $order;
            }
        }
        return $orders;

    }

    /**
     * @param Order $order
     */
    public function saveOrder(Order $order) : void {
        $sql = "INSERT INTO eshopOrder (login, accDate, sendDate, state, invoice)
                VALUES ('$order->getLogin()', '$order->getAccDate()', '$order->getSendDate()', '$order->getState()', '$order->getInvoiceNum()')";

        if ($this->mysqli->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->mysqli->error;
        }
    }

    /**
     * @param string $login
     * @param string $start
     * @param string $state
     */
   public function createOrder(string $login, string $start, string $state) : void {

        $datePattern = "/^\d{4}-\d{2}-\d{2}$/";

        if(preg_match($datePattern,$start)){
            $sql = "INSERT INTO eshopOrder ( login, start, state)
                VALUES ('$login', '$start', '$state')";
            if ($this->mysqli->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->mysqli->error;
            }
        } else {
            echo "enter date in YYYY-MM-DD";
        }
    }

    /**
     * @param int $id
     */
    public function deleteRow(int $id) : void
    {
        $sql = "DELETE FROM eshopOrder WHERE idNumOrder=$id";
        if ($this->mysqli->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $this->mysqli->error;
        }
    }

    /**
     * @param $id
     * @param $state
     */
    public function editState($id, $state) : void
    {
        $sql = "UPDATE eshopOrder SET state='$state', end= current_date WHERE idNumOrder=$id";
        if ($this->mysqli->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $this->mysqli->error;
        }
    }

    /**
     * @param Order $order
     */
    public function editOrder(Order $order) : void
    {

        $datePattern = "/^\d{4}-\d{2}-\d{2}$/";
        if(preg_match($datePattern,$order->getAccDate())){
            $sql = "UPDATE eshopOrder SET accDate= '$order->getAccDate()', sendDate='$order->getSendDate()', state='$order->getState()' WHERE idNumOrger=$order->getIdNumOrger()";
            if ($this->mysqli->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $this->mysqli->error;
            }
        }else {
            echo "enter date in YYYY-MM-DD";
        }

    }


    public function editEnd($id, $end) : void
    {
        $sql = "UPDATE eshopOrder SET sendDate='$end', state='Sent' WHERE idNumOrder=$id";
        if ($this->mysqli->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $this->mysqli->error;
        }
    }
}
