<?php
    include('../includes/02classAutoLoader_for_controllers.php');
    require ('./sessionAndCookieControl.php');

    // Getting Username
    if (strpos($_SERVER['REQUEST_URI'], "name=")){
        $nameTagLocation = strpos($_SERVER['REQUEST_URI'], "name=");
        $keepTagLocation= strpos($_SERVER['REQUEST_URI'], "?keep");
        $userName = mb_substr($_SERVER['REQUEST_URI'],$nameTagLocation+5, ($keepTagLocation-$nameTagLocation)-5);
    }else if (isset ($_COOKIE ['usernameForDashBoard'])){
        $userName = $_COOKIE ['usernameForDashBoard'];
    }else
        $userName = '';
    if (isset ($_COOKIE ["idForDashBoard"])){
        $id = $_COOKIE ["idForDashBoard"];
    }
    
    $newMessage = new Messages($GLOBALS['id']/444);
    $message = $newMessage->getMessage();
    $notification = $newMessage->getNotification();
    // echo $message[0]['Message'];
    // if (count($message)>0)
    //     echo "1";
    // echo count($message);
?>

<!DOCTYPE html> 
<html lang="en">
<head> 
     <meta charset="UTF-8"> 
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="preload" as="font" href="../fonts/ArtisticFriend-Regular.woff2" crossorigin="anonymous">
     <link rel="preload" as="font" href="../fonts/Raleway Thin.ttf" crossorigin="anonymous">
     <link rel="stylesheet" href="../css/bootstrap.min.css" >
     <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
     <link rel="stylesheet" href="../css/Dashboard/UserDashboard.css" >
     <link rel="stylesheet" href="./src/css/calendarMain.css">
     <link rel="shortcut icon" type="image/x-icon" href="../media/Slogo.PNG" />
     <title>Dashboard - <?php echo $userName; ?> </title>
</head>
<body>
<!-- The Loader class below loads before the documnet is ready -->
  <div class="loader" id="loader">
      <div class="gears">
          <img class="img-responsive big" src="../media/Dashboard/gears.png" alt="">
          <img class="img-responsive small" src="../media/Dashboard/gears.png" alt="">
      </div>
      <h3 id="gearM1">Welcome User. . . </h3>
      <h4 id="gearM2" style="margin-left: -100px;"> We are setting up your profile. </h4>
  </div>
  <!-- ------------------------------------------------------------>

  <div class="container-fluid">
        <div class="row menu-bar">
            <div class="notif-elements col-xs-3 col-sm-4 col-md-1">
                <a href="#" id="menuToggle" class="glyphicon glyphicon-list"></a>
                <span><i class="sPhonebrand">Et Pay</i></span>
                <a class="glyphicon glyphicon-envelope dropdown-toggle" data-toggle="dropdown"><span class="badge"><?php  if(is_array($message) && count($message)>0)echo count($message); else echo 0;?></span>
                    <ul class="dropdown-menu dropdown" style="margin-left: 10px;">
                    <?php 
                        if (is_array($message) && count($message)>0)
                        for ($i =0; $i<count($message); $i++){
                            echo '<li><a href="#"> <span class="">';
                            echo $message[$i]['Message'];
                            echo '</span></a></li>';
                        }
                    ?>
                    </ul>
                </a>
                <a class="glyphicon glyphicon-bell"><span class="badge">0</span></a>
                <a class="glyphicon glyphicon-tasks"><span class="badge">0</span></a>
                <a id="infoTab" class="glyphicon glyphicon-info-sign">Info</a>
            </div>
            <span class="offsetSpan col-xs-0 col-sm-1"></span>
            <span class="input-group searchbar col-sm-5 col-md-4">
                <span class="input-group-addon "> <i class="glyphicon glyphicon-search"></i> </span>
                <input type="text" class="form-control">
                <span class="input-group-btn"><button class="btn btn-info">Search</button></span>
            </span>
            <span class="logout-div col-sm-2 col-md-1">
                <a href="" class="btn btn_modf" id="logOut">Log Out</a>
            </span> 
        </div>

        <div class="sidebar">
            <div class="toggle-div">
                <a id="sidebar-toggle" class="glyphicon glyphicon-menu-left sidebar-toggle"></a>
            </div>    
            <div class="sidebar-top">
                <div class="brand-name">
                    <h2 class="brand">Et-Pay</h2>
                </div>
                <div class="user-logo-div">
                    <img class="img-responsive img-circle user-logo" src="../media/Dashboard/user2.png" alt="user picture">
                    <h3 class="textClass" style="color: gold;">Hi, <?php echo $userName; ?></h3>
                </div>
            </div>
            <div class="sidebar-middle">
                <div class="user-elements">
                    <span class="sideTitle glyphicon glyphicon-dashboard"></span> <p1 class="sidebarTexts" >Dashboard</p1>
                    <span id="profile" class="glyphicon glyphicon-user profile sidebarTexts"><a class="textClass" href=""> Profile</a></span>
                    <span id= "history" class="glyphicon glyphicon-folder-open profile sidebarTexts"><a class="textClass" href=""> History</a></span>
                </div>
                <div class="user-payments">
                    <span class="glyphicon glyphicon-briefcase sideTitle"></span> <p1 class="sidebarTexts" >Payments</p1>
                    <div id="elecBill" class=" profile sidebarTexts"><a class="textClass" href=""> Electric Bill</a></div>
                    <div id="phoneBill"  class=" profile sidebarTexts"><a style="font-size: 20px;" class="textClass" href=""> Phone/wifi Bill</a></div>
                    <div id="waterBill" class=" profile sidebarTexts"><a class="textClass" href=""> Water Bill</a></div>
                    <div id="trafficBill" class=" profile sidebarTexts"><a class="textClass" href=""> Traffic Bill</a></div>
                    <div id="taxBil" class=" profile sidebarTexts"><a class="textClass"> Tax Bill</a></div>
                </div>
                <div class="user-activities">
                    <div id="settings" class=" profile sidebarTexts"><a class="textClass" href=""> Settings</a></div>
                    <div id="contactUs" class=" profile sidebarTexts"><a class="textClass" href=""> Contact Us</a></div>
                    <div id="info" class=" profile sidebarTexts"><a class="textClass"> Information </a></div>
                    <div class=" profile sidebarTexts"><a style="color: red;" class="textClass" href=""> Delete Account</a></div>
                </div>
            </div>
        </div>

        <div class="content container-fluid">
            <div class="port">
            </div>
        </div>
        <div style="display: none">
            <?php
                if (isset ($_COOKIE ["addressForDashBoard"])){
                    $address = $_COOKIE ["addressForDashBoard"];
                }
            ?>
        <!-- This is a blind div that stores address value from the cookie when  the page load to be used on the google maps API and OpenCageData-->
            <input type="text" id="blindAddress" value="<?php echo $address ?>">
            <input type="text" id="latitude" value="">
            <input type="text" id="longtiude" value="">

        </div>
  </div>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
  <script src="../js/jquery-main-script/jquery-3.4.1.min.js" ></script>
  <script src="../js/bs-scripts/bootstrap.min.js" ></script>
  <script src="../js/Dashboard/dashboard.js"></script>
  <script src="../js/Dashboard/ajaxDashboard.js"></script>
</body>
</html>
<!-- https://getbootstrap.com/docs/3.3/components/ -->
<!-- https://www.w3schools.com/bootstrap/bootstrap_ref_all_classes.asp-->