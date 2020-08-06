<?php

class paymentHandler{
    private $userId;
    private $paymentType;
    private $paidFor; 
    private $forBillNumber;
    private $forDate;
    private $amount;
    private $conn;

    function __construct($userId, $paymentType, $paidFor, $forBillNumber, $forDate, $amount){
        $this->userId = $userId/444;
        $this->paymentType = $paymentType;
        $this->paidFor = $paidFor;
        $this->forBillNumber = $forBillNumber;
        $this->forDate = $forDate;
        $this->amount = $amount;
        $this->__conncectDB();
    }
    private function __conncectDB(){
        $connect = new DBconnect(0);
        $this->conn = $connect->getConn();
    }
    private function __processPayment(){
        // Here is where the account status of the user checked with the payment processor.
        // if the account has enough money and is active the next class will be called.
        // We are assuming there is enough money instead of create a hypothetical table.

        return $this->__registorService();
    }
    private function __registorService(){
        if ($this->paymentType ==  'Electric Bill'){
            $tableName = 'etpay_05_electric_payments';
        }else if ($this->paymentType == 'Phone And Wifi Bill'){
            $tableName = 'etpay_06_tele_payments';
        }else if ($this->paymentType == 'Water Bill'){
            $tableName = 'etpay_07_water_payments';
        }else if ($this->paymentType == 'Traffic Bill'){
            $tableName = 'etpay_08_traffic_payments';
        }
        $query="INSERT INTO $tableName ( `Uid`, `Paid_For`, `Bill_Number`, `Amount`, `For_Month`) 
                VALUES (:userid, :paidFor, :billNUmber, :amount, :forMonth)";
        $status = $this->conn->prepare($query);
        $status->bindParam(':userid',  $this->userId, PDO::PARAM_INT, 255);
        $status->bindParam(':paidFor',  $this->paidFor, PDO::PARAM_STR, 255);
        $status->bindParam(':billNUmber', $this->forBillNumber, PDO::PARAM_STR, 255);
        $status->bindParam(':amount',  $this->amount, PDO::PARAM_STR, 255);
        $status->bindParam(':forMonth', $this->forDate, PDO::PARAM_STR, 255);
        $execute_success = $status->execute();
        $status->closeCursor();
        if(!$execute_success){
            $this->count = -1;
            $error_type = 5;
            echo "EROOOOOOORRRR ";
            return 0;
            die();
        }
        $this->__registorHistory();
        return 1;
    }
    private function __registorHistory(){
        $query = "INSERT INTO `etpay_04_history`( `Uid`, `paymentType`, `paidFor`, `forDate`, `forBillNumber`, `Amount`) 
                 VALUES (:userid, :paymentType, :paidFor, :forMonth, :billNUmber, :amount)";
        $status = $this->conn->prepare($query);
        $status->bindParam(':userid',  $this->userId, PDO::PARAM_INT, 255);
        $status->bindParam(':paymentType',  $this->paymentType, PDO::PARAM_STR, 40);
        $status->bindParam(':paidFor',  $this->paidFor, PDO::PARAM_STR, 255);
        $status->bindParam(':forMonth', $this->forDate, PDO::PARAM_STR, 40);
        $status->bindParam(':billNUmber', $this->forBillNumber, PDO::PARAM_STR, 255);
        $status->bindParam(':amount',  $this->amount, PDO::PARAM_STR, 255);
        $execute_success = $status->execute();
        $status->closeCursor();
        if(!$execute_success){
            $this->count = -1;
            $error_type = 5;
            echo "EROOOOOOORRRR ";
            return 0;
            die();
        }

    }
    public function pay(){
        return $this->__processPayment();
    }
}

