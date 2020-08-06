<?php
include('../includes/02classAutoLoader_for_controllers.php');

class SessionsHandler{
    private $_cookieFromUser;
    private $_sessionId;
    private $_userId;
    private $_hashedCookie;
    private $_dbConnect;
    private $_dbConnectionStatus;
    private $_bool;

    function __construct($newcookieFromUser,$userId, $bool)
    {   
         if ($bool){
            $this->_cookieFromUser = $newcookieFromUser;
            $this->_userId = $userId;
            $this->_bool = $bool;
            $this->_hashCookieFromUser();
         }else{
             $this->_connectToDataBase();
             $this->_bool = false;
         }
    }

    private function _hashCookieFromUser(){
        $this->_hashedCookie = hash('gost', $this->_cookieFromUser);
        $this->_connectToDataBase();
    }
    private function _connectToDataBase(){
        try {
            $this->_dbConnect = new DBconnect(0);
        }catch (PDOException $e){
            $error_type = 0;
            include_once('../includes/error/02loginErrors.php');
            die(); exit();
        }
        if($this->_dbConnect->getStatus() && $this->_bool){
            $this->_updateDataBase();
        }
    }
  
    private function _updateDataBase(){
        $conn = $this->_dbConnect->getConn();
        $query="INSERT IGNORE INTO `etpay_03_sessions`(`Uid`, `session_id` , `Session_Value`) 
                VALUES (:userId, :sessionId, :hashedCookie) ON DUPLICATE KEY UPDATE `Session_Value`=:hashedCookie";

        $this->_dbConnectionStatus = $conn->prepare($query);
        $this->_dbConnectionStatus->bindParam(':userId',  $this->_userId, PDO::PARAM_INT, 255);
        $this->_dbConnectionStatus->bindParam(':sessionId', $this->_cookieFromUser, PDO::PARAM_STR, 255);
        $this->_dbConnectionStatus->bindParam(':hashedCookie', $this->_hashedCookie, PDO::PARAM_STR, 255);
        try {
            $this->_dbConnectionStatus->execute();
        }catch (PDOException $e){
            $this->_dbConnectionStatus->closeCursor();
            // echo "error ".$e->getMessage();
            $error_type = 1;
            include_once('../includes/error/02loginErrors.php');
            die(); exit();
        }
        
            
        
    }

    public function checkSession($sessionId){
        $conn = $this->_dbConnect->getConn();
        $query = "SELECT `Uid`, `session_id`, `Session_Value` FROM `etpay_03_sessions` WHERE `session_id` = :sessionId";
        $this->_dbConnectionStatus = $conn->prepare($query);
        $this->_dbConnectionStatus->bindParam(':sessionId',  $sessionId, PDO::PARAM_STR, 255);
        $execute_success = $this->_dbConnectionStatus->execute();
        if (!$execute_success){
            $this->_dbConnectionStatus->closeCursor();
            $error_type = 2;
            include_once('../includes/error/02loginErrors.php');
            return false;
            die(); exit();
        }else if ($this->_dbConnectionStatus->rowCount()>0){
            $content = $this->_dbConnectionStatus->fetchAll();
            return $content[0];
            $this->_dbConnectionStatus->closeCursor();
        }else {
            return false;
            $this->_dbConnectionStatus->closeCursor();
        }
    }

    public function destroySession ($sessionId){
        $conn = $this->_dbConnect->getConn();
        $query = "DELETE FROM `etpay_03_sessions` WHERE `session_id` = :sessionId";
        $this->_dbConnectionStatus = $conn->prepare($query);
        $this->_dbConnectionStatus->bindParam(':sessionId',  $sessionId, PDO::PARAM_STR, 255);
        $this->_dbConnectionStatus->execute();
        $this->_dbConnectionStatus->closeCursor();
    }
    function __destruct()
    {
        if ($this->_bool)
            $this->_dbConnectionStatus->closeCursor();
    }
}   
