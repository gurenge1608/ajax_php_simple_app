<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "examples";
    $msg = "";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if(!empty($_POST)) {
        $name = $_POST['name'];
        $year = $_POST['year'];
        
      
            $sql = "INSERT INTO cars (`name`, `year`) VALUES ('$name', '$year')";
            
            if ($conn->query($sql) === TRUE) {
              $msg = "New record created successfully";
              $sql = "SELECT * FROM cars ORDER BY ID DESC LIMIT 1";
              $result = $conn->query($sql);
              echo json_encode($result->fetch_assoc());
            } else {
              $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
        
    }
    
    
    $conn->close();
?>

