<?php
include('../includes/02classAutoLoader_for_controllers.php');

class sign_up
{
    private $first_name;
    private $fathers_name;
    private $last_name;
    private $atm_num;
    private $atm_pin;
    private $cvv;
    private $exp_date;
    private $bank_name;
    private $email;
    private $city;
    private $subcity;
    private $woreda;
    private $phone_number;
    private $is_email_sent;
    protected $prop_array_all;
    protected $userName;
    protected $password;
    private $hashed_password;
    protected $newdata_toEngine;

    public function __construct($first_name, $fathers_name, $last_name, $atm_num, $atm_pin, $cvv, $exp_date, $bank_name, $email, $city, $subcity, $woreda, $phone_number)
    {
        $this->first_name = $first_name;
        $this->fathers_name = $fathers_name;
        $this->last_name = $last_name;
        $this->atm_num = $atm_num;

        $hashed_pin = new hash_pw_pin();
        $this->atm_pin = $hashed_pin->hashpin($atm_pin);
        $this->cvv = $cvv;
        $this->exp_date = $exp_date;
        $this->bank_name = $bank_name;
        $this->email = $email;
        $this->city = $city;
        $this->subcity = $subcity;
        $this->woreda = $woreda;
        $this->phone_number = $phone_number;
        $this->prop_array_all = array(
            $this->first_name, $this->fathers_name, $this->last_name, $this->atm_num, $this->atm_pin, $this->cvv,
            $this->exp_date, $this->bank_name, $this->email, $this->city, $this->subcity, $this->woreda, $this->phone_number
        );

        $this->validate_();
    }

    private function validate_()
    {    
        $prop_array_strings = array($this->first_name, $this->fathers_name, $this->last_name, $this->bank_name, $this->city, $this->subcity);
        $prop_array_number = array($this->atm_num, $this->cvv, $this->woreda, $this->phone_number);
        for ($i = 0; $i < count($this->prop_array_all); $i++) {
            if ($this->prop_array_all[$i] == '' || $this->prop_array_all[$i] == ' ') {
                $error_type = 0;
                include_once('../includes/error/00sign_up_err.php');
                die();
                exit(); //incase either of the depreciate
            }
        }
        foreach ($prop_array_strings as $test)
            if (preg_match("/[^A-Za-z _] /", $test)) {
                $error_type = 1;
                include_once('../includes/error/00sign_up_err.php');
                die();
                exit(); //incase either of the depreciate
            }
        foreach ($prop_array_number as $test)
            if (!ctype_digit($test)) {
                $error_type = 2;
                include_once('../includes/error/00sign_up_err.php');
                die();
                exit(); //incase either of the depreciate
            }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $error_type = 3;
            include_once('../includes/error/00sign_up_err.php');
            die();
            exit(); //incase either of the depreciate
        }
        if (preg_match("/[^0-9\/]/", $this->exp_date)) {
            $error_type = 6;
            include_once('../includes/error/00sign_up_err.php');
            die();
            exit();
        } else {
            $this->atmCRED_validate();
            // return true;
        }
    }
    private function atmCRED_validate()
    {
        /*
            atm pin validate contennt
        */
        $this->toEngine_();
    }
    private function toEngine_()
    {
        // include ('../includes/02classAutoLoader_for_controllers.php');
        $status = false;
        $this->newdata_toEngine = new engine_sign_up($this->prop_array_all, 1);
        if ($this->newdata_toEngine->get_status()) {
            $status = $this->newdata_toEngine->insert_exe();
            if ($status == false) {
                $error_type = 5;
                include_once('../includes/error/00sign_up_err.php');
                return $status;
                die();
                exit(); //incase either of the depreciate
            } else{
                $this->get_credentials();
                }
        } else {
            $error_type = 5.1;
            include_once('../includes/error/00sign_up_err.php');
            die();
            exit(); //incase either of the depreciate
        }
        // return $status;
    }
    private function get_credentials()
    {
        $newuser = new create_cred($this->first_name, $this->fathers_name);
        $this->userName = $newuser->getUsername();
        $this->password = $newuser->getPassword();
        $this->send_Email_();
    }

    private function send_Email_()
    {
        $email_to_user = new emailer($this->email, $this->userName, $this->password);
        $stat = $email_to_user->getstat();
        if (!$stat) {
            $this->register_user($stat);
        } else {
            $this->register_user($stat);
        }
    }

    private function register_user($stat)
    {
        $hash = new hash_pw_pin();
        $this->hashed_password = $hash->hashpassword($this->password);
        $package = array($stat, $this->userName, $this->hashed_password);
        $this->newdata_toEngine->register($package);
    }
       
}



if (isset($_POST['new_user_Email'])) {
    /* 
        First, check if the ATM number and email doesnt exist
        by calling the check user class.
    */
    $checkUser = new check_user("signup-fromAjax", $_POST['new_user_Email'],$_POST['new_user_bank_name'], $_POST['new_user_ATM'],0,0);
    if ($checkUser->getRowCount()==0){
        unset($checkUser);
        $sanitize =  new sanitize();
        $first_name =$sanitize->__sanitize ($_POST['new_user_name'],0);
        $fathers_name = $sanitize->__sanitize($_POST['new_user_fathers_name'],0);
        $last_name = $sanitize->__sanitize($_POST['new_user_last_name'],0);
        $atm_num = $sanitize->__sanitize($_POST['new_user_ATM'],2);
        $atm_pin = $sanitize->__sanitize($_POST['new_user_ATM_pin'],2);
        $cvv = $sanitize->__sanitize($_POST['new_user_CVV'],2);
        $exp_date = $sanitize->__sanitize($_POST['new_user_expdate'],4);
        $bank_name = $sanitize->__sanitize($_POST['new_user_bank_name'],1);
        $email = $sanitize->__sanitize($_POST['new_user_Email'],3);
        $city =  $sanitize->__sanitize($_POST['new_user_city'],1);
        $subcity =  $sanitize->__sanitize($_POST['new_user_subcity'],1);
        $woreda =  $sanitize->__sanitize($_POST['new_user_woreda'],2);
        $phone_number =  $sanitize->__sanitize ($_POST['new_user_phone_number'],2);

        $prop_array_all = array($first_name, $fathers_name, $last_name, $atm_num, $atm_pin, $bank_name, $email,
                                $city, $subcity, $woreda, $phone_number);

        foreach ($prop_array_all as $test) {
            if ($test == '' || $test == ' ') {
                $error_type = 0;
                include_once('../includes/error/00sign_up_err.php');
                die();
                exit(); //incase either of the depreciate
            }
        }

        $new_user_data = new sign_up($first_name, $fathers_name, $last_name, $atm_num, $atm_pin, $cvv,$exp_date, $bank_name, $email, $city, $subcity, $woreda, $phone_number);
    }else if($checkUser->getRowCount()>0){
        $error_type = 8;
        include_once('../includes/error/00sign_up_err.php');
    }
}
