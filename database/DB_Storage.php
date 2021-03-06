<?php
declare(strict_types=1);
include "../classes/Order.php";
include "../classes/Customer.php";
include "../classes/Invoice.php";

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

    public function getAllInvoices(){
        $query = "SELECT * FROM invoice ";
        $invs = [];
        if($result = $this->mysqli->query($query)){
            while($row = $result->fetch_row() ){
                $inv = new Invoice($row[0], $row[1], $row[2]);
                $invs[] = $inv;
            }
        }
        return $invs;
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
                    echo  "<h2> U????vate?? s dan??m loginom alebo emailom u?? existuje </h2>";
                }
            }
            $stmt_login->close();
        }
    }

    function newCustomer(string $meno, string $priezvisko, string $login, string $passwd, string $email){
        $hash_psw = password_hash($passwd, PASSWORD_DEFAULT);
        $idNumCust = uniqid();
        $role = "customer";

        $stmt_user = $this->mysqli->prepare("INSERT INTO user (login, password, role) VALUES (?, ?, ?)");
        $stmt_customer = $this->mysqli->prepare("INSERT INTO customer (idNumCust, name, surname, login, email) VALUES ('$idNumCust',?, ?, ?, ?)");
        
        $stmt_user->bind_param("sss", $login, $hash_psw, $role);
        $stmt_user->execute();

        $stmt_customer->bind_param("ssss", $meno, $priezvisko, $login, $email);
        $stmt_customer->execute();

        if ($stmt_user->affected_rows + $stmt_customer->affected_rows == 2) {
            echo "OK";
            $_SESSION["LoginOK"]=0;
            $_SESSION["role"] = 'customer';
            $_SESSION["username"] = $login;
        }

        $stmt_user->close();
        $stmt_customer->close();
    }

    /**
     * @param Order $order
     */
    public function editOrder($id, $datum, $stav) : void
    {
        $datePattern = "/^\d{4}-\d{2}-\d{2}$/";
        if(preg_match($datePattern,$datum)){
            $sql = "UPDATE eshopOrder SET accDate= '$datum', state='$stav' WHERE idNumOrder=$id";
            if ($this->mysqli->query($sql) === TRUE) {
                //echo "Record updated successfully";
                header('Location: admin.php');
            } else {
                //echo "Error updating record: " . $this->mysqli->error;
                echo '<script>alert("Error updating record")</script>';
            }
        } else {
            echo '<script>alert("enter date in YYYY-MM-DD")</script>';
        }

    }

    /**
     * @param int $id
     */
    public function deleteOrder(int $id) : void
    {
        $sql = "DELETE e.*, i.* FROM eshopOrder e, invoice i WHERE e.invoice = i.idNumInv AND e.idNumOrder=$id";
        if ($this->mysqli->query($sql) === TRUE) {
            //echo "Record deleted successfully";
            header('Location: admin.php');
        } else {
            echo '<script>alert("Error deleting record")</script>';
        }
    }

    /**
     * @param $id
     * @param $state
     */
    public function editState($id, $state) : void
    {
        $sql = "UPDATE eshopOrder SET state='$state', sendDate= current_date WHERE idNumOrder=$id";
        if ($this->mysqli->query($sql) === TRUE) {
            //echo "Record updated successfully";
            //header('Location: admin.php');
        } else {
            echo '<script>alert("Error updating record")</script>';
        }
    }

    /**
     * @param $login
     * @param $meno
     * @param $priezvisko
     * @param $email
     */
    public function editCustomer($meno, $priezvisko, $login, $email) : void
    {
        $sql = "UPDATE customer SET name= '$meno', surname='$priezvisko' , email='$email' WHERE login='$login'";
        if ($this->mysqli->query($sql) === TRUE) {
            echo "Zaznam aktualizovany!";
            header('Location: administration.php');
        } else {
            echo "Error updating record: " . $this->mysqli->error;
            //echo 'Error updating record';
        }
    }

    /**
     * @param int $id
     */
    public function deleteCustomer($login) : void
    {
        /* Start transaction */
        $this->mysqli->begin_transaction();
        //echo "jahdkjagsd";
        try {

            $sql = "delete o, i from eshopOrder o, invoice i where o.login = '$login' and i.idNumInv = o.invoice;";
            //echo $sql;
            $this->mysqli->query($sql);

            $this->mysqli->commit();

            $sql = "delete u, c from user u, customer c where u.login = '$login' and u.login = c.login;";
            //echo $sql;
            $this->mysqli->query($sql);

            $this->mysqli->commit();

        } catch (mysqli_sql_exception $exception) {
            $this->mysqli->rollback();
            throw $exception;
        }
    }

//delete u, c, o, i from user u, customer c, eshopOrder o, invoice i where u.login = 'kkalusova' and c.login = u.login and o.login=u.login and i.idNumInv = o.invoice;

    /**
     * @param string $login
     * @param string $start
     * @param string $state
     */
    public function createOrder(string $login) : void {
        $invoice = uniqid();

        /* Start transaction */
        $this->mysqli->begin_transaction();
        try {
            $sql = "INSERT INTO eshopOrder ( login, accDate, state, invoice) VALUES ('$login', current_date, 'registered', '$invoice');";
            //echo $sql;
            $this->mysqli->query($sql);
            $this->mysqli->commit();

            $sql = "INSERT INTO invoice ( idNumInv, issueDate) VALUES ('$invoice', current_date);";
            //echo $sql;
            $this->mysqli->query($sql);
            $this->mysqli->commit();

            $_SESSION['objednane'] = 1;
            echo '<script>alert("Dakujeme za objednavku!")</script>';

        } catch (mysqli_sql_exception $exception) {
            $this->mysqli->rollback();
            throw $exception;
        }

    }

}
