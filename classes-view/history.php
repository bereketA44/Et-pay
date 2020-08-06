<?php
    include ('./ajaxValidateCS.php');
    include('../includes/02classAutoLoader_for_controllers.php');

    class History {
        private $conn;
        private $userHistory;
        private $userId;
        private $rowCount;
        function __construct($userId){
            $this->userId = $userId;
            $this->__connectDB();
        }
        private function __connectDB(){
            $connect = new DBconnect(0);
            $this->conn = $connect->getConn();
            $this->__fetchUserHistory();
        }
        private function __fetchUserHistory(){
            $query = "SELECT `paymentType`, `paidFor`, `forDate`, `forBillNumber`, `Amount`, `Date` FROM `etpay_04_history` WHERE `Uid`=:userId";
            $status = $this->conn->prepare($query);
            $status ->bindParam(':userId',  $this->userId, PDO::PARAM_INT, 255);
            try{
                $execute_success =  $status ->execute();
                $this->rowCount =  $status ->rowCount();
            }catch(PDOException $e){
                echo "something went wrong".$e->getMessage();
            }
            if(!$execute_success){
                echo "<h2> Something Went Wrong </h2> <br>";
            }else if ( $status ->rowCount()>0){
                $this->userHistory = $status->fetchAll();
            }else{
                echo "<h3> You have no history </h3>";
            }
        }

        public function getHistory(){
            return $this->userHistory;
        }
        public function getRowCount(){
            return $this->rowCount;
        }
    }
    $newUser = new History( $GLOBALS['id']/444);
    $content = $newUser->getHistory();
?>
<style>
    .history {
        width: 80%;
        font-family: Optima, Helvetica, sans-serif;
        box-shadow: 1px 1px 20px black;
    }
    .table-striped > tbody > tr:nth-child(1) > td, .table-striped > tbody > tr:nth-child(1) > th {
        background-color: #171520 !important;
        font-family: Optima, Helvetica, sans-serif;
        color: gold !important;
        font-size: 40px;
    }
    .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
        background-color: lightgrey;
        color: black;
        font-size: 20px;
    }
    .table-striped > tbody > tr:nth-child(2n) > td, .table-striped > tbody > tr:nth-child(2n) > th {
        background-color: whitesmoke;
        color: black;
        font-size: 20px;
    }
    tr>td, th{
        font-family: Optima, Helvetica, sans-serif;
        max-width: 33.3vw;
        /* overflow-x: auto; */
        /* height: 300px; */
        overflow-wrap: break-word;
        word-wrap: break-word;
        /* overflow-x: auto; */
        white-space: pre-wrap;
        border: #352944 1px solid;
    }
    @media (max-width: 768px){
        .history{
            width: 100vw;
        }
    }
</style>
   
<div class="history">
    
   <table class="table table-striped table-hover customTable">
            <tr>
                <th>Past Payment Type</th><th>Paid for</th><th>For date</th><th>Bill Number</th><th>Amount</th><th>On Date</th>
            </tr>
        <?php
            for ($i=0; $i<$newUser->getRowCount(); $i++){
                echo "<tr><td>";
                echo $content[$i]['paymentType'];
                echo "</td><td>";
                echo $content[$i]['paidFor'];
                echo "</td><td>";
                echo $content[$i]['forDate'];
                echo "</td><td>";
                echo $content[$i]['forBillNumber'];
                echo "</td><td>";
                echo $content[$i]['Amount'];
                echo "</td><td>";;
                echo $content[$i]['Date'];
                echo "</td></tr>";
                
            }
        ?>

    </table>
</div>