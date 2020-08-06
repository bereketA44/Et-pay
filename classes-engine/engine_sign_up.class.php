<?php
error_reporting(E_ALL ^E_DEPRECATED);
ini_set('display_errors', 1);

class engine_sign_up
{
        private $properties;
        private $query;
        private $status;
        private $conn;
        private $constructor_status;
        private $lastInsertedId;
        public function __construct($array, $error_type){

         try{
            $this->constructor_status = true;
            $this->properties = $array;
            $connect = new DBconnect(0);
            $this->conn = $connect->getConn();

            $this->query="INSERT INTO `etpay_01_all_users`(`user_id`, `FirstName`, `FathersName`, `LastName`, `ATM_number`, 
            `ATM_PIN_Hashed`,`CVV`, `Exp_date`, `Bank_Name`, `Email`, `City`, `Subcity`, `Woreda`, `Phone_number`) 
            VALUES ('', :first_name, :fathers_name, :last_name, :atm_num, :atm_pin, :cvv, :exp_date, :bank_name, :email, :city, :subcity, :woreda, :phone_number)";

            $this->status = $this->conn->prepare($this->query);

            $this->status->bindParam(':first_name',  $this->properties[0], PDO::PARAM_STR, 30);
            $this->status->bindParam(':fathers_name', $this->properties[1], PDO::PARAM_STR, 30);
            $this->status->bindParam(':last_name', $this->properties[2], PDO::PARAM_STR, 30);
            $this->status->bindParam(':atm_num', $this->properties[3], PDO::PARAM_STR, 17);
            $this->status->bindParam(':atm_pin', $this->properties[4], PDO::PARAM_STR, 255);
            $this->status->bindParam(':cvv', $this->properties[5], PDO::PARAM_STR, 255);
            $this->status->bindParam(':exp_date', $this->properties[6], PDO::PARAM_STR, 8);
            $this->status->bindParam(':bank_name', $this->properties[7], PDO::PARAM_STR, 60);
            $this->status->bindParam(':email', $this->properties[8], PDO::PARAM_STR, 40);
            $this->status->bindParam(':city', $this->properties[9], PDO::PARAM_STR, 30);
            $this->status->bindParam(':subcity', $this->properties[10], PDO::PARAM_STR, 30);
            $this->status->bindParam(':woreda', $this->properties[11], PDO::PARAM_INT, 4);
            $this->status->bindParam(':phone_number', $this->properties[12], PDO::PARAM_STR, 14);
         }catch(UnexpectedValueException $e){
             $this->constructor_status = false;
             echo "Engine construct fail".$e->getMessage();
             exit();
         }catch(PDOException $e){
            $this->constructor_status = false;
            echo "Engine construct fail".$e->getMessage();
            exit();
         }
    
     }
    public function get_status(){
        if (!$this->constructor_status)
            $this->status->closeCursor();
        return $this->constructor_status; 
    }

      /*  *********************** Getting the primary key vlaue through lastInsertId() ******************
        The ID that was generated is maintained in the server on a per-connection basis. 
        This means that the value returned by the function to a given client is the first AUTO_INCREMENT value generated
        for most recent statement affecting an AUTO_INCREMENT column by that client. This value cannot be affected by other clients, 
        even if they generate AUTO_INCREMENT values of their own. This behavior ensures that each client can retrieve its own ID without 
        concern for the activity of other clients, and without the need for locks or transactions. 
     */ 

    public function insert_exe()
    {
        $execute_success = $this->status->execute();
        $this->lastInsertedId = $this->conn->lastInsertId();
        if (!$execute_success){
            $this->status->closeCursor();
            return false;
            die();
            exit();
        }
        return true;
    }

    public function register($package)
    {
        $this->query="INSERT INTO `etpay_02_registered`( `User_id`, `User_name`, `password_hashed`, `is_email_sent`) 
                        VALUES (:user_id, :user_name, :pass_hashed, :is_email_sent)";

        $this->status = $this->conn->prepare($this->query);
        $this->status->bindParam(':user_id',  $this->lastInsertedId, PDO::PARAM_INT, 255);
        $this->status->bindParam(':user_name', $package[1], PDO::PARAM_STR, 15);
        $this->status->bindParam(':pass_hashed', $package[2], PDO::PARAM_STR, 255);
        $this->status->bindParam(':is_email_sent', $package[0], PDO::PARAM_INT, 1);
        $execute_success = $this->status->execute();
        if (!$execute_success){
            $this->status->closeCursor();
            echo "<br> error at execute 12";
            return false;
            die();
            exit();
        }else{

            if($package[0]==0){
                $error_type=7;
                include_once ('../includes/error/00sign_up_err.php');
            }else if($package[0]==1){
                $sccs_type=0;
                include_once ('../includes/success/00sign_up_sccs.php');
            }
        }

        $this->__messageUser();
    }
    private function __messageUser(){
        $query = "INSERT INTO `etpay_09_messages`( `Uid`, `Message`) VALUES (:userId, 'Welcome to Etpay')";
        $status = $this->conn->prepare($query);
        $status->bindParam(':userId',  $this->lastInsertedId, PDO::PARAM_INT, 255);
        $execute_success = $status->execute();
        if (!$execute_success){
            echo "<br> error at execute 113 at engine";
            return false;
            die();
            exit();
        }
        $status->closeCursor();
    }
    function __destruct()
    {
        $this->status->closeCursor();
    }
}
?>