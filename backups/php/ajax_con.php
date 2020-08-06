<?php
class dbcon{
        const host = "localhost";
        const username = "bereket";
        const password = "";
        protected $dbname;// = "test_etpay_test" ;
        protected $conn;
    
    // public function __construct(){
        
    // }
    public function connectdb(){
        $host = self::host;
        try {
            $this->conn = new PDO("mysql:host=".self::host.";dbname=".$this->dbname, self::username, self::password);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            echo "@ connectdb Connected successfully";
        }catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
            $this->conn="";
        }
        // $this->conn = "bbbbb";
    }
}
class getdata extends dbcon{
    private $stmt;
    private $status;
    private $result;

    public function __construct(){
            $this->dbname = "test_etpay_test";
            echo "riunning";
        try{  
            $this->connectdb();
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
            exit();
        }     
    }
    public function fetch_full(){
       
        $this->stmt = 'SELECT * FROM username LIMIT 4';
        $this->status=$this->conn->prepare( $this->stmt);
        $this->status->execute();
        $this->result =$this->status->fetchAll() ;
        $this->status->closeCursor();
        return $this->result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="./css/bootstrap.min.css" >
     <title>Title_Here</title>
     <script>
        $(function(){
          let line = 2;
            $("#show").click(function(){
              line = line + 2;
                $("#field").load("ajax_con.php",{
                  linepassed: line
                });
            });
        })
     </script>
</head>
<body>
    <div class="container-fluid">
        <h1>Db file</h1>
        <table class='table table-striped table-hover table-condensed table-responsive'>
                <tr>
                    <th>Name</th><th>ATM</th><th>pasword</th><th>check</th><th>phone</th>
                </tr>;
                <div class="container-fluid">
                    <div id="field">
                    <?php
                        // $line  = $_POST['linepassed'];
                        // echo "------>".$line."<br>";
                        $newobj =  new getdata();
                        $result = $newobj->fetch_full();
                        foreach ($result as $student){
                            echo "<tr>";
                            echo "<td> ".$student['name']."</td>";
                            echo "<td> ".$student['ATM']."</td>";
                            echo "<td> ".$student['password']."</td>";
                            echo "<td> ".$student['check']."</td>";
                            echo "<td> ".$student['Phone']."</td>";
                            echo "</tr>";
                        }
                            echo " </table>";
                    ?>

                    </div>
                    <button id="show">show users</button>
                </div>
           
    </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js" ></script>
</body>
</html>
<!-- https://getbootstrap.com/docs/3.3/components/ -->
<!-- https://www.w3schools.com/bootstrap/bootstrap_ref_all_classes.asp-->