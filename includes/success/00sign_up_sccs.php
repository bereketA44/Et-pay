<!DOCTYPE html> 
	<head>
		<title>ET-pay Sign up Success</title>
	</head>
<?php
     include ('../includes/00header-incl-loader.html');
    //  include ('../')
     
?>

	<head>
		<title>ET-pay Sign up Success</title>
	</head>

<!-- ********************************php starts here************************* -->
       <h1 style="color: red"> 
           <?php
            if ($sccs_type == 0){
                echo "<h1> You have been successfully signed in </h1> <br>";
                echo "<h2> Please goto your email and get your username and password, then go back to log in </h2><br>";
            }
           
            ?>
        </h1>
        <button onclick="history.back()" style="font-size: 20px" class='btn btn-warning'>< Go back</button>

<!-- ********************************php ends here************************* -->
<?php
    include ('../includes/01footer-incl-loader.html')
?>