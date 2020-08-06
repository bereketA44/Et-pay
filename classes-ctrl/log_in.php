<?php
include('../includes/02classAutoLoader_for_controllers.php');

class LogIn{
    private $username;
    private $password;
    private $atm_num;
    private $login_Status;
    private $_firstName; 
    private$_userId;
    function __construct($username, $password, $atm_num)
    {
        $this->username = $username;
        $this->password = $password;
        $this->atm_num = $atm_num;
        // echo $this->atm_num;
        $this->_checkRegisteredUser();
    }

    private function _checkRegisteredUser(){
        $check =  new check_user("logIn-fromAjax", 0,0, $this->atm_num, $this->username, $this->password);
        $this->_firstName = $check->getUserFirstName();
        $this->_userId = $check->getUserId();
        $this->login_Status = $check->getLoginStatus();
    }
    public function getLoginStatus(){
        return $this->login_Status;
    }
    public function getUserInfo(){
        return array ($this->_firstName, $this->_userId);
    }
}
if (isset($_POST['login_username']) 
    && isset($_POST['login_atm']) 
    && isset($_POST['login_password'])){

    $username = $_POST['login_username'];
    if ($_POST['login_atm'][0]== '0')
        $ATM = $_POST['login_atm'];
    else
        $ATM = number_format($_POST['login_atm'], 0 ,'','');
    $password = $_POST['login_password'];
    $login =  new LogIn($username, $password,$ATM );
    $login_cookie = 0;
    
    if ($login->getLoginStatus()){
        if (isset($_POST['remember_me'])){
            $login_cookie = "";
        }else{
            $login_cookie = "rmclosed";
        }
        $firstName = $login->getUserInfo()[0];
        $userId = $login->getUserInfo()[1];
        $sessionId = $userId*444;
        $newcookie = new CookiesHandler($sessionId);
        $newsession =  new SessionsHandler($newcookie->getCoookie(), $userId, true);

        setcookie("loggin_accessed_etpay", "true", time() + 1800, "/"); //1800 is 30 minutes
        setcookie("ETSESSID_etpay_token", $newcookie->getCoookie(), time() + 1800,"/");
        setcookie("usernameForDashBoard", $firstName, time() + 1800 * 1800, "/");
        setcookie("idForDashBoard", $sessionId, time() + 1800 * 1800, "/");
        setcookie("uNameForDashboard", $username, time() + 1800 * 1800, "/");

        header("Location: ../classes-view/user_dashboard.php?name={$firstName}?keep={$login_cookie}?for={$sessionId}" ,TRUE,301);
    }else{
        // Stay at current page
    }
}
