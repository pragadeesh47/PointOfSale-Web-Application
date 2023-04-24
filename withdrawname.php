<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$num = $_POST['num'];
$id = $_POST['id'];
$name = $_POST['name'];
if($num==0){
    $query = "UPDATE withdraw SET name = '$name' WHERE id = '$id' AND email = '$email'";
    $result = mysqli_query($con, $query);
}
elseif($num==1){
    $query = "DELETE FROM withdraw  WHERE id  = '$id' AND email = '$email'";
    $result = mysqli_query($con, $query);
}
?>