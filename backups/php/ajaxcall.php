<?php
    include 'dbc.php';
    if (isset($_POST['linepassed'])){
    $line = $_POST['linepassed'];
    $line2 = abs($line);
    echo "-->".$line2.'<br>';
    $limit = 5;
    $query = "SELECT * FROM `username` LIMIT :num";
    $state = $conn->prepare($query);

    $state->bindValue(":num", intval( trim($line2)), PDO::PARAM_STR);
    $execute_success=$state-> execute();

    if (!$execute_success)
        {
            die(print_r($state->errorInfo(), true));
        }else{
           
            echo "<br> phone ---><br>";
            // header ('Location: ./5.OOPdb.php?success');
        }
    $result = $state->fetchAll();
    // $state->closeCursor();
        echo "<table class='table table-striped table-hover table-condensed table-responsive'>" ;
        echo "<tr>";
        echo "<th>Name</th><th>ATM</th><th>pasword</th><th>check</th><th>phone</th>";
        echo "</tr>";
    foreach ($result as $student){
      echo "<tr>";
      echo "<td> ".$student['name']."</td>";
      echo "<td> ".$student['ATM']."</td>";
      echo "<td> ".$student['password']."</td>";
      echo "<td> ".$student['check']."</td>";
      echo "<td> ".$student['Phone']."</td>";
      echo "</tr>";
  }
        echo "</table>";
}
?>