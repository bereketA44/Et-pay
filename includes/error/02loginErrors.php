<?php
     include ('../includes/00header-incl-loader.html');
    //  include ('../')
     
?>
<!-- ********************************php starts here************************* -->
    <h1 style="color: red"> 
        <?php
            if ($error_type == 0){
                echo "Error <br>";
                echo "Unable to setup session. Database connection failed trying to set up session <br>";
            } else if ($error_type == 1){
                echo "Error <br>";
                echo "Unable to setup session. Database connection failed @ session Update. User could be blocked from accessing or not in database. Please contact the contact person <br>";
            }else if ($error_type == 2){
                echo "Error <br>";
                echo "Unable to setup session. Database connection failed @ session Check <br>";
            }
           
        ?>
    </h1>
    <button style="font-size: 20px" class='btn btn-warning'>< Go back</button>

<!-- ********************************php ends here************************* -->
<?php
    include ('../includes/01footer-incl-loader.html')
?>