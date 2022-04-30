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
        
        $id = $_POST['id'];
        $name = $_POST['name'];
        $year = $_POST['year'];
        $sql = "UPDATE cars SET name='$name', year='$year' WHERE id = '$id'";
        
        if ($conn->query($sql) === TRUE) {
          $msg = "Cập nhật thành công";
          $sql = "SELECT * FROM cars WHERE id = '$id'";
        $result = $conn->query($sql);
        echo json_encode($result->fetch_assoc());
        } else {
          $msg = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    
    
    $conn->close();
?>
