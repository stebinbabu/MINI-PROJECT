<?php    
$database="e_panchayat";
$conn = mysqli_connect("localhost","root","","$database");
  
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error."<br>");
}
?>