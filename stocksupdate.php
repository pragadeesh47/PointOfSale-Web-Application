<?php
require("db.php");
require("auth_session.php");

$email = $_SESSION['email'];
$id = $_POST['id'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$date = date("Y-m-d");


$query = "SELECT * FROM stocks WHERE email = '$email' AND stocks_id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$getQuantity = $row['quantity'];
$newQuantity = (int) $quantity + $getQuantity;
if($price!="" && $quantity!=""){
    $query = "UPDATE stocks SET quantity = '$newQuantity', price = '$price' WHERE email = '$email' AND stocks_id = '$id'";
    $result = mysqli_query($con, $query);

    $query = "UPDATE details SET rate = '$price' WHERE email = '$email' AND sale_id = '$id'";
    $result = mysqli_query($con, $query);

    $query = "INSERT INTO stockshistory (stock_id,quantity,price,date,email) VALUES('$id','$quantity','$price','$date','$email')";
    $result = mysqli_query($con, $query);

}
elseif($quantity!="" && $price==""){
    $query = "UPDATE stocks SET quantity = '$newQuantity' WHERE email = '$email' AND stocks_id = '$id'";
    $result = mysqli_query($con, $query);

    $query = "INSERT INTO stockshistory (stock_id,quantity,date,email) VALUES('$id','$quantity','$date','$email')";
    $result = mysqli_query($con, $query);
}
else{
    $query = "UPDATE stocks SET price = '$price' WHERE email = '$email' AND stocks_id = '$id'";
    $result = mysqli_query($con, $query);

    $query = "UPDATE details SET rate = '$price' WHERE email = '$email' AND sale_id = '$id'";
    $result = mysqli_query($con, $query);

    $query = "INSERT INTO stockshistory (stock_id,quantity,date,email) VALUES('$id','$quantity','$date','$email')";
    $result = mysqli_query($con, $query);
}

$query = "SELECT * FROM stocks WHERE email = '$email' AND stocks_id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$updatedQuantity = $row['quantity'];
$updatedPrice = $row['price'];
$final = $updatedQuantity.=".$updatedPrice";
echo $final;
?>