<?php
require("db.php");
require("adminauth.php");
$id = $_POST['id'];
$status = $_POST['status'];
if($status==1){
    $query = "UPDATE admin SET status = 1 WHERE user_id = '$id'";
    $result = mysqli_query($con, $query);
    
    $query = "SELECT * FROM admin WHERE user_id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $shopname = $row['shopname'];
    $userId = $row['user_id'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $address = $row['address'];
    $pincode = $row['pincode'];
    $password = $row['password'];
    
    $query  = "INSERT INTO users (user_id,username,email,mobile,address,pincode,password) VALUES('$userId','$shopname','$email','$mobile','$address','$pincode','$password')";
    $result = mysqli_query($con, $query);
}
else{
    $query = "UPDATE admin SET status = 2 WHERE user_id = '$id'";
$result = mysqli_query($con, $query);

$query = "SELECT * FROM admin WHERE user_id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
if($row['status']==2){
    $query = "DELETE FROM admin WHERE status = 2";
    $result = mysqli_query($con, $query);
}
}

?>