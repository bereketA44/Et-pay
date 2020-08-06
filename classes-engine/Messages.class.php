<?php
    class Messages{
        private $userId;
        private $conn;
        private $messages;
        private $msgCount;
        private $notification;
        private $notifCount;

        function __construct($userId){
            $this->userId = $userId;
            $this->__conncectDB();
        }
        private function __conncectDB(){
            $connect = new DBconnect(0);
            $this->conn = $connect->getConn();
            $this->__fetchMessages();
            $this->__fetchNotificationss();
        }   
        private function __fetchMessages(){
            $query = "SELECT `Message` FROM `etpay_09_messages` WHERE `Uid`=:userId";
            $status = $this->conn->prepare($query);
            $status ->bindParam(':userId',  $this->userId, PDO::PARAM_INT, 255);
            try{
                $execute_success =  $status ->execute();
                $this->msgCount =  $status ->rowCount();
            }catch(PDOException $e){
                echo "something went wrong".$e->getMessage();
            }
            if(!$execute_success){
                echo "<h2> Something Went Wrong </h2> <br>";
            }else if ( $this->msgCount>0){
                $this->messages = $status->fetchAll();
            }else{
                $this->msgCount = 0;
            }
        } 
        private function __fetchNotificationss(){
            $query = "SELECT `Message` FROM `etpay_10_notification` WHERE `Uid`=:userId";
            $status = $this->conn->prepare($query);
            $status ->bindParam(':userId',  $this->userId, PDO::PARAM_INT, 255);
            try{
                $execute_success =  $status ->execute();
                $this->notifCount =  $status ->rowCount();
            }catch(PDOException $e){
                echo "something went wrong".$e->getMessage();
            }
            if(!$execute_success){
                echo "<h2> Something Went Wrong </h2> <br>";
            }else if ( $this->msgCount>0){
                $this->notification = $status->fetchAll();
            }else{
                $this->notifCount = 0;
            }
        } 

        public function getMessage(){
            if ($this->msgCount>0){
                return $this->messages;
            }else
                return '';
        }
        public function getNotification(){
            if ($this->notifCount>0){
                return $this->notification;
            }else
                return '';
        }
        public function getCounts(){
            return array($this->msgCount, $this->notifCount);
        }
    }
?>