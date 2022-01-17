<?php
declare(strict_types=1);
include "../classes/Order.php";
include "../classes/Customer.php";

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
    public function getAllOrders() : array {
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
     * @return Customer[]
     */
    public function getAllCustomers() : array {
        $query = "SELECT * FROM customer c ";
        $customers = [];
        if($result = $this->mysqli->query($query)){
            while($row = $result->fetch_row() ){
                $customer = new Customer($row[0], $row[1], $row[2], $row[3], $row[4]);
                $customers[] = $customer;
            }
        }
        return $customers;
    }

    function checkRegis(string $meno, string $priezvisko, string $login, string $passwd, string $email){
        if( $stmt_login = $this->mysqli->prepare("SELECT * FROM user WHERE user.login = ?") ) {
            $stmt_login->bind_param("s", $login);
            $stmt_login->execute();
            $result_login = $stmt_login->get_result();

            if ($stmt_email = $this->mysqli->prepare("SELECT * FROM customer WHERE customer.email = ?")) {
                $stmt_email->bind_param("s", $email);
                $stmt_email->execute();
                $result_email = $stmt_email->get_result();

                if ($result_login->num_rows === 0 && $result_email->num_rows === 0)  {
                    $this->newCustomer($meno, $priezvisko, $login, $passwd, $email);
                    $stmt_email->close();
                } else {
                    echo  "<h2> Užívateľ s daným loginom alebo emailom už existuje </h2>";
                }
            }
            $stmt_login->close();
        }
    }

    function newCustomer(string $meno, string $priezvisko, string $login, string $passwd, string $email){
        $hash_psw = password_hash($passwd, PASSWORD_DEFAULT);
        $idNumCust = uniqid();
        $role = "customer";
        $stmt_user = $this->mysqli->prepare("INSERT INTO 'user' (login, password, role) VALUES (?,'$hash_psw', '$role')");
        $stmt_customer = $this->mysqli->prepare("INSERT INTO customer (idNumCust, name, surname, login, email) VALUES ('$idNumCust',?, ?, ?, ?)");

        if( $stmt_user && $stmt_customer) {

            $stmt_user->bind_param("s", $login);
            $stmt_customer->bind_param("ssss", $meno, $priezvisko, $login, $email);

            //$stmt_user->execute();
            $stmt_customer->execute();

            if($stmt_user->execute()){
                echo "TU SOM";
            }else{
                echo "NEPRESLO";
            }
            $stmt_user->close();
            $stmt_customer->close();

            $_SESSION["LoginOK"]=0;
            $_SESSION["role"] = 'customer';
            $_SESSION["username"] = $login;

            //header("LOCATION: ../pages/index.php");
        }
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
