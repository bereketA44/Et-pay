<?php
    include('../includes/02classAutoLoader_for_controllers.php');
    if (isset ($_POST['log_out'])){
            session_start();
            unset ($_SESSION['ETSESSID_etpay_token']);
            unset ($_SESSION['timeControlatLogin']);
            setcookie("loggin_accessed_etpay", "false", time() - 15800, "/"); 
            setcookie("ETSESSID_etpay_token", $_COOKIE['ETSESSID_etpay_token'], time() - 15800,"/");     
            session_unset();
            session_destroy();
        }
    session_start();
    unset ($_SESSION['ETSESSID_etpay_token']);
    unset ($_SESSION['timeControlatLogin']);
    session_unset();
    session_destroy();
    setcookie("loggin_accessed_etpay", "false", time() - 15800, "/"); 
    setcookie("ETSESSID_etpay_token", 0, time() - 15800,"/"); 
    setcookie("usernameForDashBoard",0, time() - 180000 * 1800, "/");
    setcookie("idForDashBoard", 0, time() -  180000 * 1800, "/");
    setcookie("delSessFromDBforAjaxCalls", 0, time() - 1800 * 1800,"/");
    setcookie("emailForDashBoard", 0, time() -  180000 * 1800, "/");
    $checkSession = new SessionsHandler(0,0,0);
        if (isset ($_COOKIE ["delSessFromDBforAjaxCalls"])){    
            $thisSession= $_COOKIE ["delSessFromDBforAjaxCalls"];
            $checkSession->destroySession($thisSession);
        } 
        header("Location: ../index.html");
        die();
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="../css/bootstrap.min.css" >
     <title>Title_Here</title>
</head>
<body>
    <div class="container-fluid">
        <form action="">
            <input type="text" name="" id="">
            <input type="text">
            <button>login</button>
        </form>
        
    </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="../js/bs-scripts/bootstrap.min.js" ></script>
</body>
</html>