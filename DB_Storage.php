<?php
declare(strict_types=1);
include "Order.php";

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
        $query = "SELECT * FROM Orders";
        $orders = [];
        if($result = $this->mysqli->query($query)){
            while($row = $result->fetch_row() ){
                $order = new Order($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
                $orders[] = $order;
            }
        }
        return $orders;

    }
    public function saveOrder(Order $order) : void {
        $sql = "INSERT INTO Orders (meno, priezvisko, start, end, state)
                VALUES ('$order->name', '$order->surname', '$order->start', '$order->end', '$order->state')";

        if ($this->mysqli->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->mysqli->error;
        }
    }
    public function createOrder(string $name, string $surname, string $start, string $state) : void {
        $sql = "INSERT INTO Orders (meno, priezvisko, start, state)
                VALUES ('$name', '$surname', '$start', '$state')";
        if ($this->mysqli->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->mysqli->error;
        }
    }

    public function deleteRow(int $id) : void
    {
        $sql = "DELETE FROM Orders WHERE id=$id";
        if ($this->mysqli->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $this->mysqli->error;
        }
    }

    public function editState($id, $state) : void
    {
        $sql = "UPDATE Orders SET state='$state' WHERE id=$id";
        if ($this->mysqli->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $this->mysqli->error;
        }
    }

    public function editOrder($id, $name, $surname, $accDate, $state) : void
    {
        $sql = "UPDATE Orders SET meno= '$name', priezvisko='$surname', start='$accDate', state='$state' WHERE id=$id";
        if ($this->mysqli->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $this->mysqli->error;
        }
    }
    public function editEnd($id, $end) : void
    {
        $sql = "UPDATE Orders SET end='$end', state='Closed' WHERE id=$id";
        if ($this->mysqli->query($sql) === TRUE) {
            //echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $this->mysqli->error;
        }
    }
}
