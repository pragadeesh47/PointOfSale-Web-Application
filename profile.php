<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];


if(isset($_POST['email'])){

    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $query = "UPDATE users SET mobile = '$mobile', username = '$name', address = '$address', pincode = '$pincode' WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $mobile = $row['mobile'];
    $name = $row['username'];
    $address = $row['address'];
    $pincode = $row['pincode'];
    $finally = "$email".",$name".",$mobile".",$address".",$pincode";
    echo $finally;
    
}
else{
    $query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$email = $row['email'];
$mobile = $row['mobile'];
$name = $row['username'];
$address = $row['address'];
$pincode = $row['pincode'];
$finally = "$email".",$name".",$mobile".",$address".",$pincode";
echo $finally;
}

?>