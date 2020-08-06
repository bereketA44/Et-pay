<?php
    if ($error_type==1)
        include ('../includes/00header-incl-loader.html');
    else
        include ('../00header-incl-loader.html');
?>
<!-- ********************************php starts here************************* -->
       <h1> <?php
            echo "Error connecting to the database <br>";
            echo "Error type--->".$err_msg."<br>";
            echo '<p style="color: red; font-size: 35px">'.'@ line--->'.$e->getLine().'</p>';
            ?>
        </h1>

<!-- ********************************php ends here************************* -->
<?php
    if ($error_type==1)
        include ('../includes/01footer-incl-loader.html');
    else
        include ('../01footer-incl-loader.html')
?>