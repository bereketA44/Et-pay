<?php
     include ('../includes/00header-incl-loader.html');
    //  include ('../')
     
?>
<!-- ********************************php starts here************************* -->
    <h1 style="color: red"> 
        <?php
            if ($error_type == 0){
                echo "Error <br>";
                echo "Error type---> You have an empty field please go back to the previous 
                page and carefully fill all fields on the sign up form <br>";
            } else 
            if ($error_type == 1){
                echo "Error <br>";
                echo "Error type---> You have used a number in one of the text fields. Please Go back to the previous 
                page and carefully fill all fields on the sign up form <br>";
            } else
            if ($error_type == 2){
                echo "Error <br>";
                echo "Error type---> You have used a text in one of the number fields. Please Go back to the previous 
                page and carefully fill all fields on the sign up form <br>";
            } else
            if ($error_type == 3){
                echo "Error <br>";
                echo "Error type---> You used a wrong E-mail format. Please Go back to the previous 
                page and carefully fill all fields on the sign up form <br>";
            } else
            if ($error_type == 4){
                echo "class auto loader error";
            } else
            if ($error_type == 5){
                echo "Error <br>";
                echo " Sorry the server is down for the moment, please try again later<br>";
            } else
            if ($error_type == 5.1){
                echo "Error <br>";
                echo "PDO error, Sorry the server is down for the moment, please try again later<br>";
            } else
            if ($error_type == 6){
                echo "Error <br>";
                echo "Please go back to the sign up form and use a proper date format on entering the expiry date. Use '00/00' format as
                printed in the card<br>";
            } else
            if ($error_type == 7){
                echo "Error <br>";
                echo "<h1> Error sending email, make sure you are connected to the internet and the email you provided is valid</h1>";
                echo "";
            } else
            if ($error_type == 8){
                echo "Notice <br>";
                echo "<h2> You have already signed up with Et-pay. Please use the username and password sent to your email address to log in. Please check your spam folder if you havent gotten any.</h2>";
                echo "";
            }
        ?>
    </h1>
    <button style="font-size: 20px" class='btn btn-warning'>< Go back</button>

<!-- ********************************php ends here************************* -->
<?php
    include ('../includes/01footer-incl-loader.html')
?>