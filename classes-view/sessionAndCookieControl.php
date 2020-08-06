<?php
    include('../includes/02classAutoLoader_for_controllers.php');
    session_start();

    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $checkSession = new SessionsHandler(0,0,0);    
    if (!isset($_SESSION["ETSESSID_etpay_token"])) {
        if (isset ($_COOKIE["ETSESSID_etpay_token"]) 
            && isset($_COOKIE["loggin_accessed_etpay"]) 
            && $_COOKIE["loggin_accessed_etpay"] == true) {
                $thisCookie = $_COOKIE ["ETSESSID_etpay_token"];
                $stat = $checkSession->checkSession($thisCookie);
                if (is_array($stat)) { 
                    if (!hash_equals($stat["Session_Value"],hash('gost', $thisCookie))){
                        header("Location: ./login quick.php?1");
                        die();
                    }
                    else { 
                        $_SESSION["ETSESSID_etpay_token"] = $thisCookie;
                        $_SESSION['timeControlatLogin'] = time();
                    }
                } else{
                    header("Location: ./login quick.php?2");
                    die();
                }
        } else 
            if (!isset($_SESSION["ETSESSID_etpay_token"])
            || !isset ($_COOKIE ["ETSESSID_etpay_token"])
            || !isset($_COOKIE["loggin_accessed_etpay"])){
                header("Location: ./login quick.php?3");
                die();
            }
        }else{         
            if (isset ($_COOKIE ["ETSESSID_etpay_token"]) 
                && isset($_COOKIE["loggin_accessed_etpay"]) 
                 && $_COOKIE["loggin_accessed_etpay"] == true ){
                    setcookie("loggin_accessed_etpay", "true", time() + 1800, "/"); //1800 is 30 minutes
                    setcookie("ETSESSID_etpay_token", $_SESSION["ETSESSID_etpay_token"], time() + 1800,"/");
            }
        }

        if (strpos($url, "rmclosed") 
            && isset ($_SESSION['timeControlatLogin'])) {
                $loginTime = $_SESSION['timeControlatLogin'];
                if (time() - $loginTime < 1800){
                    $_SESSION['timeControlatLogin']=time();
                }else{
                    if (isset ($_COOKIE ["ETSESSID_etpay_token"]) || isset($_SESSION["ETSESSID_etpay_token"])){
                        $thisCookie = $_COOKIE ["ETSESSID_etpay_token"];
                        $thisSession = $_SESSION["ETSESSID_etpay_token"];
                        $checkSession->destroySession($thisCookie);
                        $checkSession->destroySession($thisSession);
                    }
                    unset ($_SESSION['ETSESSID_etpay_token']);
                    unset ($_SESSION['timeControlatLogin']);
                    session_unset();
                    session_destroy();
                    header("Location: ./login quick.php?v");
                    die();
                }
                
        }else if(isset ($_SESSION['ETSESSID_etpay_token']))  {
            $_SESSION['timeControlatLogin']=time();
            setcookie("loggin_accessed_etpay", "true", time() + 1800, "/"); //1800 is 30 minutes
            setcookie("ETSESSID_etpay_token", $_SESSION["ETSESSID_etpay_token"], time() + 1800,"/");
        }
        //  to delete the session from database after the 30 minutes is done and the user clicks on the ajax buttons
        if (isset ($_COOKIE["ETSESSID_etpay_token"]))
            setcookie("delSessFromDBforAjaxCalls", $_COOKIE["ETSESSID_etpay_token"], time() + 1800 * 1800,"/"); 

?>