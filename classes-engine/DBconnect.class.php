<?php
// error_reporting(E_ALL ^(E_DEPRECATED | E_NOTICE));
DEFINE  ('DB_USER', 'bereket');
DEFINE ('DB_PW', ''); 
DEFINE ('SOURCE', 'mysql:host=localhost; dbname=etpay_Main');

class DBconnect{
    private $conn='';
    private $status;
    public function __construct($ATTR_EMULATE_PREPARES)
    {
        try{
            // $ATTR_EMULATE_PREPARES = 0;
            $this->conn = new PDO(SOURCE, DB_USER, DB_PW);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //Fetchs associtive array from db
            if($ATTR_EMULATE_PREPARES==1)
                $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //enables Prepared statments that are done though bindvalue and bindparam
            else
                $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, true); //disables Prepared statments that are done though bindvalue and bindparam
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->status = 1;;
        }catch(PDOException $e){
            $this->status = 0;
            $err_msg = $e->getMessage();
            include('../includes/error/01conn_error.php');
        }
    }
    public function getStatus(){
        return $this->status;
    }
    public function getConn(){
        if ($this->status == 1)
            return $this->conn;
        else
            return -1;
    }
}


