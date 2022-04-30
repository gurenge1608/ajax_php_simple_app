<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "examples";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM cars WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
      //echo "Record deleted successfully";
    } else {
     // echo "Error deleting record: " . $conn->error;
    }
}


$conn->close();

?>