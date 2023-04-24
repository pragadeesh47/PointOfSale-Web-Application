<?php 
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$id  = $_POST['id'];
$which = $_POST['which'];
if($which == 0){
    $query = "DELETE FROM purchase WHERE email = '$email' AND shop_id = '$id'";
    $result = mysqli_query($con, $query);
}
elseif($which == 1){
    $query = "DELETE FROM service WHERE email = '$email' AND customer_id = '$id'";
    $result = mysqli_query($con, $query);
}
elseif($which == 2){
    $query = "DELETE FROM customers WHERE email = '$email' AND customer_ID = '$id'";
    $result = mysqli_query($con, $query);
}
elseif($which == 3){
    $query = "DELETE FROM orders WHERE email = '$email' AND order_id = '$id'";
    $result = mysqli_query($con, $query);
}
elseif($which == 4){
    $query = "DELETE FROM customerdetails WHERE email = '$email' AND customer_id = '$id'";
    $result = mysqli_query($con, $query);
}
?>