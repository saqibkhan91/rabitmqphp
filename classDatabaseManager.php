<?php
date_default_timezone_set('Europe/Paris');
class databaseManager {
    private $dns='mysql:host=localhost;dbname=c0app_atbhash;charset=utf8';
    private $dnsserver='mysql:host=localhost;dbname=users;charset=utf8';
    private $username='root';
    private $usernameserver='root';
    private $password='/1JS~JPRk!mt2|z$';
    private $passwordserver='Arshad_123';
    private $db_conn=NULL;
    function __construct(){
        try {
            $this->db_conn = new PDO($this->dnsserver, $this->usernameserver ,$this->passwordserver);
        } catch (PDOException $e) {
            return false;
        }
    }

    function executeQuery($query, $values, $type){
        try {
            $statement = $this->db_conn->prepare($query);
            if($statement) {
                switch($type){
                    case 'create':
                        $result=$statement->execute($values);
                        if($result){
                            $result=$this->db_conn->lastInsertId();
                            return $result;
                        }else{
                            $error = $statement->errorInfo();
                            echo "Query failed with message: " . $error[2];
                            return false;
                        }
                        break;
                    case 'mcreate':
                        $passed = true;
                        $result = null;
                        foreach ($values as $value){
                            $result=$statement->execute($value);
                            if($result){
                                $result=$this->db_conn->lastInsertId();
                            }else{
                                $error = $statement->errorInfo();
                                echo "Query failed with message: " . $error[2];
                                $passed = false;
                                break;
                            }
                        }
                        if($passed){
                            return true;
                        }else{
                            return false;
                        }
                        break;
                    case 'cread':
                        $result = $statement->execute($values);
                        if($result) {
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            /* echo '<pre>';
                                print_r($result);
                            echo '</pre>'; */
                            return $result;
                        } else {
                            $error = $statement->errorInfo();
                            echo "Query failed with message: " . $error[2];
                            return false;
                        }
                        break;
                    case 'sread':
                        $result = $statement->execute();
                        if($result) {
                            $result = $statement->fetchAll();
                            return $result;
                        } else {
                            $error = $statement->errorInfo();
                            echo "Query failed with message: " . $error[2];
                        }
                        break;

                    case 'update':

                        $result=$statement->execute($values);
                        if($result){
                            return true;
                        }else{
                            $error = $statement->errorInfo();
                            echo "Query failed with message: " . $error[2];
                            return false;
                        }
                        break;

                    case 'delete':
                        $result = $statement->execute($values);
                        if($result) {
                            return $result;
                        } else {
                            $error = $statement->errorInfo();
                            echo "Query failed with message: " . $error[2];
                        }
                        break;

                    default:
                        echo 'invalide query type';
                }
            }
        } catch (PDOException $e) {
            echo "A database problem has occurred: " . $e->getMessage();
        }
    }

    public function startTransaction(){
        $this->db_conn->beginTransaction();
    }
    public function commitTransaction(){
        $this->db_conn->commit();
    }
    public function rollBackTransaction(){
        $this->db_conn->rollBack();
    }

}
?>
