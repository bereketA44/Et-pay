<?php
  include 'dbc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="./css/bootstrap.min.css" >
     <title>ajax test</title>
   
</head>
<body>
    <div class="container-fluid">
        <h1>Testing Ajax</h1>
        <div id="field">
            <table class='table table-striped table-hover table-condensed table-responsive'>
                    <!-- <tr>
                        <th>Name</th><th>ATM</th><th>pasword</th><th>check</th><th>phone</th>
                    </tr>; -->
            <?php
                $limit= 4;
                $query = 'SELECT * FROM username LIMIT 3';
                $state = $conn->prepare($query);
                $state->bindParam(':lt', $limit);
                $execute_success=$state-> execute();
                $result = $state->fetchAll();
                $state->closeCursor();
                // echo "<br> phone --->".$execute_success;
                 
                  if (!$execute_success)
                  {
                    die(print_r($state->errorInfo(), true));
                  }
                foreach ($result as $student){
                  echo "<tr>";
                  echo "<td> ".$student['name']."</td>";
                  echo "<td> ".$student['ATM']."</td>";
                  echo "<td> ".$student['password']."</td>";
                  echo "<td> ".$student['check']."</td>";
                  echo "<td> ".$student['Phone']."</td>";
                  echo "</tr>";

              }
              
            ?>
            </table>
        </div>
        <button id="show">show users</button>

        <form class="form-group">
            <h1>Register</h1>
            <input id="name1" type="name" name="name" placeholder="User name"  required >
            <input type="password" name="pass" placeholder="Password"  required >
            <input type="Number" name="ATM" placeholder="ATM" required  > 
            <input type="Number" name="phone" placeholder="Phone Number"  required >
            <button id="insert" type="button" name="signup">Sign Up</button>
        </form> 
        <h1 id="success"></h1>
    </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="./js/bs-scripts/bootstrap.min.js" ></script>
  <script>
        $(function(){
          let line = 2;
            $("#show").click(function(){
              // alert("ber");
              line = line + 2;
                $("#field").load("ajaxcall.php",{
                  linepassed: line
                });
            });
            $("#insert").click(function(){
                alert($("#name1").val())
            });
           
        })
     </script>
</body>
</html>
<!-- https://getbootstrap.com/docs/3.3/components/ -->
<!-- https://www.w3schools.com/bootstrap/bootstrap_ref_all_classes.asp-->