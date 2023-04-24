<?php 
require("auth_session.php");
require("db.php");
$email = $_SESSION['email'];

if($_POST['id']!="" && $_POST['name']!="" && $_POST['rate']==""){
$id = $_POST['id'];
$name = $_POST['name'];
$query = "UPDATE details SET item = '$name' WHERE email = '$email' AND sale_id = '$id'";
$result  = mysqli_query($con, $query);
}
else if($_POST['id']!="" && $_POST['rate']!="" && $_POST['name']==""){
    $id = $_POST['id'];
    $rate = $_POST['rate'];
    $query = "UPDATE details SET rate = '$rate' WHERE email = '$email' AND sale_id = '$id'";
    $result  = mysqli_query($con, $query);
}
else if($_POST['name']!="" && $_POST['rate']!=""){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $rate = $_POST['rate'];
    $query = "UPDATE details SET rate = '$rate', item = '$name' WHERE email = '$email' AND sale_id = '$id'";
    $result  = mysqli_query($con, $query);
}

?>