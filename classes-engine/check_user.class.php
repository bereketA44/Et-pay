<?php
include('../includes/02classAutoLoader_for_controllers.php');

class check_user{
    private $email;
    private $bank;
    private $atm_num;
    private $username;
    private $password;
    private $status;
    private $count;
    private $conn;
    private $dataBaseContent;
    private $loginStatus;
    private $__firstName;
    private $__userId;

    public function __construct($target, $email, $bank, $atm_num, $username, $password)
    {
        $sanitize =  new sanitize();
        $this->atm_num = $sanitize->__sanitize($atm_num, 2);
        $this->__userId='';
        $this->__firstName = '';
        $connect = new DBconnect(0);
        $this->conn = $connect->getConn();
        if ($target == "signup-fromAjax"){
            if (empty($email) || empty($bank) || empty ($atm_num)){
                $this->count =-1;
            }else{
                $this->email= $sanitize->__sanitize($email, 3);
                $this->bank = $sanitize->__sanitize($bank, 1);
                $this->checkSignUp();
            }
        }else if ($target == "logIn-fromAjax"){
            if (empty($atm_num) || empty($username) || empty ($password)){
                $this->loginStatus = false;
                $this->count =-1;
            }else{
                $this->username =  $sanitize->__sanitize($username, 5);
                $this->password = $password;
                $this -> checkLogIn();
            }
        }
    }

    private function checkSignUp(){
        
        $query = "SELECT `Email` , `ATM_number`, `Bank_Name` FROM `etpay_01_all_users` WHERE `Email` = :email && `ATM_number`= :atm_num
        && `Bank_Name` =:bank" ;
        // SELECT `ATM_number`, `Email` FROM `etpay_01_all_users` WHERE `ATM_number`= 123 && `Email` = 'AAdmin_etpay2-01'
        $this->status = $this->conn->prepare($query);
        $this->status->bindParam(':atm_num',  $this->atm_num, PDO::PARAM_STR, 17);
        $this->status->bindParam(':bank',  $this->bank, PDO::PARAM_STR, 60);
        $this->status->bindParam(':email', $this->email, PDO::PARAM_STR, 40);
        $execute_success = $this->status->execute();
        $this->count = $this->status->rowCount();
        $this->status->closeCursor();
        if(!$execute_success){
            $this->count = -1;
            $error_type = 5;
            include_once('../includes/error/00sign_up_err.php');
        }
    }
    private function checkLogIn(){
        // $query = "SELECT `User_name`, `password_hashed` FROM `etpay_02_registered` WHERE `user_name`=:userName";
        $query = "SELECT etpay_01_all_users.user_id, etpay_01_all_users.FirstName, etpay_02_registered.User_name, etpay_01_all_users.ATM_number,
                etpay_02_registered.password_hashed FROM etpay_02_registered JOIN etpay_01_all_users 
                ON etpay_01_all_users.user_id = etpay_02_registered.User_id
                WHERE etpay_02_registered.User_name =:userName && etpay_01_all_users.ATM_number=:ATM";
        $this->status =$this->conn->prepare($query);
        $this->status->bindParam(':userName',  $this->username, PDO::PARAM_STR, 15);
        $this->status->bindParam(':ATM',  $this->atm_num, PDO::PARAM_STR, 17);
        try{
            $execute_success = $this->status->execute();
        }catch(PDOException $e){
            echo "something went wrong".$e->getMessage();
        }
        if(!$execute_success){
            $this->count = -1;
            $this->loginStatus = false;
            $error_type = 5;
            include_once('../includes/error/00sign_up_err.php');
            die();
        }else{
            $this->count = $this->status->rowCount();
            if ($this->status->rowCount()>0){
                $this->dataBaseContent = $this->status->fetchAll();
                $this->checkPasswordandATM();
            }else if ($this->status->rowCount()==0){
                $this->loginStatus = false;
            }
           
        }
    }
    private function checkPasswordandATM(){
        // echo $this->password."<br>";
        // echo $this->dataBaseContent[0]['password_hashed'];
        // echo "<br> ATM from db---->". $this->dataBaseContent[0]['ATM_number']."<br>";
        // echo "<br> ATM from user---->". $this->atm_num."<br>";
        // $str = (string)$this->dataBaseContent[0]['password_hashed'];
        // echo "<br> checkign--->". password_verify($this->password, $this->dataBaseContent[0]['password_hashed'] );
        if (password_verify('~*E2tep6Y0*~*Y69t93E5*~'.$this->password, $this->dataBaseContent[0]['password_hashed'] )&& 
            $this->dataBaseContent[0]['ATM_number']==$this->atm_num){
            $this->__firstName = $this->dataBaseContent[0]['FirstName'];
            $this->__userId = $this->dataBaseContent[0]['user_id'];
            $this->loginStatus =true;
        }
        else 
            $this->loginStatus = false;
    }
    public function getLoginStatus(){
        return $this->loginStatus;
    }
    public function getUserFirstName(){
        return $this->__firstName;
    }
    public function getUserId(){
        return $this->__userId;
    }
    public function getRowCount(){
        return $this->count;
    }
    function __destruct()
    {
        $this->status->closeCursor();
    }
}
/* 
test cases below 
$rr = 1111111111111111;
$new = new check_user("logIn-fromAjax", 'NA', 'NA', number_format($rr, 0 ,'',''), 'berber-4822', '2di5wc34qv');
if ($new->getLoginStatus()){
    echo "<br> row count---->".$new->getRowCount();
    echo "<h1> can log in </h1>";
    echo "<h1> welcome ".$new->getUserFirstName()."</h1>";
}else{
    echo "<h1> wrong username, ATM number or password </h1>";
}
*/
