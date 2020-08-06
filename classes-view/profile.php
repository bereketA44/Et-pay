<?php
    include('../includes/02classAutoLoader_for_controllers.php');
    include ('./ajaxValidateCS.php');

    class Profile {
        private $conn;
        private $connect;
        private $userInfo;
        private $userid;
        function __construct(){
            $this->userid =  $GLOBALS['id']/444;
            $this->connectTodb();
        }
        private function connectTodb(){
            $this->connect = new DBconnect(0);
            $this->conn = $this->connect->getConn();
            if ($this->connect->getStatus())
                $this->__fetchUserInfo();
        }
        private function __fetchUserInfo(){
            $query = "SELECT `user_id`, `FirstName`, `FathersName`, `LastName`, `ATM_number`, `ATM_PIN_Hashed`, `CVV`, `Exp_date`, 
                     `Bank_Name`, `Email`, `City`, `Subcity`, `Woreda`, `Phone_number` FROM `etpay_01_all_users` WHERE `user_id`=:userId";
            $this->connect = $this->conn->prepare($query);
            $this->connect ->bindParam(':userId',  $this->userid, PDO::PARAM_INT, 255);
            try{
                $execute_success = $this->connect ->execute();
            }catch(PDOException $e){
                echo "something went wrong".$e->getMessage();
            }
            if(!$execute_success){
                echo "<h2> Something Went Wrong </h2> <br>";
            }else if ($this->connect ->rowCount()>0){
                $this->userInfo = $this->connect ->fetchAll();
                $this->getAccountStatus();
            }
        }
        private function getAccountStatus(){

        }
        public function getUserInfo (){
            return $this->userInfo;
        }
        function __destruct(){
            $this->connect->closeCursor();
        }
    }

    $newUser = new Profile();
    $content = $newUser->getUserInfo();
    setcookie("emailForDashBoard", $content[0]['Email'], time() +  180000 * 1800, "/");
    $address = $content[0]['Subcity'].', '.$content[0]['City'].', '.'Ethiopia';
    setcookie("addressForDashBoard", $address, time() +  180000 * 1800, "/");

?>

<style>
.profile-content{
    white-space: normal;
    word-wrap: break-word;
    padding: 0;
}
.profile-content>.basic-profile, .detail-profile{
    height: auto;
    font-family: Optima, Helvetica, sans-serif;
    background-color: #FFFFFF;
    /* margin-left: -20px; */
    box-shadow: #c2bcc7 -5px -10px 50px 10px;
}
.basic-profile-title, .detail-profile-title{
    margin: 0 -15px 0 -15px;
    background-color: #171520;
    height: 45px;
    color: Gold;
    box-shadow: rgb(175, 157, 157)-1px 6px 10px;
    height: auto;
}
.basic-profile-title>h2, .detail-profile-title>h2{
    display: inline-block;
    margin: 5px 0px 0px 15px;
}
.basic-profile-title>a, .detail-profile-title>a{
    cursor: pointer;
    font-size: 30px;
    float: right;
    margin-right: 10px;
    margin-top: 2px;
    color: Gold;
    text-decoration: none;
}
.basic-profile-names, .detail-profile-atm{
    border-bottom: 1px solid thistle;
}

.detail-profile{
    margin-top: 20px;
}
.account-status{
    background-color: #EAEAEA;
    margin-top: 30px;
}
.glossary{
    white-space: normal;
    text-align: center;
}
.activeAcc, .inactiveAcc{
    font-size: 75px;
}
.activeAcc{
    color: grey;
    display: block;
}
.inactiveAcc{
    color: red;
    text-shadow: 0px 3px 15px  orange;
    display: none;
}
</style>
<div class="row"> 
    <div class="profile-content col-md-6 col-md-offset-0 ">
        <div class="basic-profile col-md-12 col-md-offset-1">
            <div class="basic-profile-title">
                <h2>Basic Information</h2> 
                <a title="Edit" class="glyphicon glyphicon-edit"></a>   
            </div>
            <div class="basic-profile-names">
                <h2> Name: 
                    <p1 class="profile-Fname"><?php echo $content[0]['FirstName']?></p1> 
                    <p1 class="profile-Mname"><?php echo $content[0]['FathersName']?></p1>
                    <p1 class="profile-Lname"><?php echo $content[0]['LastName']?></p1>
                </h2>
                <h2>User Name:
                    <p1 class="profile-Fname"><?php if(isset ($_COOKIE['uNameForDashboard'])) echo $_COOKIE['uNameForDashboard']; else echo "";?></p1> 
                </h2>
            </div>
            <div class="basic-profile-address">
                <h2 class="profile-City">City: <?php echo $content[0]['City']?></h2>
                <h2 class="profile-Subcit">Sub City: <?php echo $content[0]['Subcity']?></h2>
                <h2 class="profile-woreda">Woreda: <?php echo $content[0]['Woreda']?></h2>
                <h2 class="profile-phone">Phone:0<?php echo $content[0]['Phone_number']?></h2>
            </div>
        </div>
        <div class="detail-profile col-md-12 col-md-offset-1">
            <div class="detail-profile-title">
                <h2>Detailed Information</h2> 
                <a title="Edit" class="glyphicon glyphicon-edit"></a>   
            </div>
            <div class="detail-profile-atm">
                <h2> ATM number: 
                    <p1 class="profile-atm"><?php echo $content[0]['ATM_number']; ?></p1> 
                </h2>
                <h2> CVV: 
                    <p1 class="profile-atm"><?php echo $content[0]['CVV']; ?></p1> 
                </h2>
                <h2> ATM Expiration Date: 
                    <p1 class="profile-Edate"><?php echo $content[0]['Exp_date']?></p1> 
                </h2>
                <h2> Bank Name: 
                    <p1 class="profile-bank"><?php echo $content[0]['Bank_Name']?></p1> 
                </h2>
            </div>
            <div class="detail-profile-email">
                <h2>Email:
                    <p1 class="profile-email"><?php echo $content[0]['Email']?></p1> 
                </h2>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="profile-sidebars col-md-3 col-offset-1">
        <div class="customCalender col-md-12">
            <div id="myCalendar" style="height: 370px; width:100% !Important" class="vanilla-calendar" style="margin-bottom: 20px">                
            </div>
        </div>
        <div class="account-status col-md-12">
            <div class="glossary">
                <h2 style="border-bottom: 1px solid black; text-align: center">Account status</h2>
                <p class="glyphicon glyphicon-ok-circle activeAcc"></p>
                <p class="glyphicon glyphicon-ban-circle inactiveAcc"></p>
                <h2  style="border-bottom: 1px solid black; text-align: center">active</h2>
            </div>
        </div>
    </div>
</div>  
    <script src="./src/js/vanilla-calendar-min.js"></script>
    <script src="./src/js/calCustom.js"></script>
    <script>
    $(function () {
        let addressLine = $("#blindAddress").val();
        console.log(addressLine);
        let latitude = 0;
        let longitude = 0;
        // $.getJSON('https://api.opencagedata.com/geocode/v1/json?key=839cff3dac4648d1a82443859ca7be8b&q='+addressLine+'&pretty=1&no_annotations=1', 
        // function(data) {
        //         var text = data;
        //         latitude = text.results[0].bounds.southwest.lat;
        //         longitude = text.results[0].bounds.southwest.lng;
        //         // console.log (text);
        //         $("#latitude").val(latitude);
        //         $("#longtiude").val(longitude);
        //         console.log(latitude);
        //         console.log(longitude);

        // });
    });
</script>