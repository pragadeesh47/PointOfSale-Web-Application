<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$id = $_POST['id'];
$status = $_POST['status'];
if($status=="1"){
    $query = "SELECT * FROM service WHERE email = '$email' AND customer_id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $balance = $row['balance_amount'];
    echo $balance;
}
elseif($status=="2"){
    $query = "SELECT * FROM service WHERE email = '$email' AND customer_id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $balance = $row['advance_amount'];
    echo $balance;
}
elseif($status=="3"){
    $query = "SELECT * FROM service WHERE email = '$email' AND customer_id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $balance = $row['advance_amount'];
    echo $balance;
}
?>