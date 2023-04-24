<?php
require("auth_session.php");
require("db.php");
$email = $_SESSION['email'];
$id = $_POST['id'];
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $query = "UPDATE  networks SET network = '$name' WHERE email = '$email' AND id = '$id'";
    $result = mysqli_query($con, $query);
    $query = "UPDATE  daily SET item = '$name' WHERE email = '$email' AND id = '$id'";
    $result = mysqli_query($con, $query);
}
else{
    $query  = "DELETE FROM networks WHERE email = '$email' AND id = '$id'";
    $result = mysqli_query($con, $query);
    $query  = "DELETE FROM daily WHERE email = '$email' AND id = '$id'";
    $result = mysqli_query($con, $query);
}
?>