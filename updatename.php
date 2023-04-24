<?php 
require("auth_session.php");
require("db.php");
$email = $_SESSION['email'];
$id = $_POST['id'];
$name = $_POST['name'];
$query = "UPDATE stocks SET stocks = '$name' WHERE email = '$email' AND stocks_id = '$id'";
$result = mysqli_query($con, $query);
$query = "UPDATE details SET item = '$name' WHERE email = '$email' AND sale_id = '$id'";
$result = mysqli_query($con, $query);
echo $name;
?>