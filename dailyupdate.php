<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$status = $_POST['status'];
$id = $_POST['id'];
$amount = $_POST['amount'];
$date = date("Y-m-d");

if($status=="0"){
    $query = "UPDATE daily SET opening = '$amount', date = '$date' WHERE email = '$email'AND id = '$id'";
    $result = mysqli_query($con,$query);

    $query = "SELECT * FROM daily WHERE email = '$email' AND id = '$id'";
    $result = mysqli_query($con, $query);   
    $row = mysqli_fetch_assoc($result);
    $opening = $row['opening'];
    $purchase = $row['purchase'];
    $closing = $row['closing'];
    $final = $row['profit'];
}
elseif($status=="1"){
    $query = "UPDATE daily SET purchase = '$amount', date = '$date' WHERE email = '$email' AND id = '$id'";
    $result = mysqli_query($con,$query);

    $query = "SELECT * FROM daily WHERE email = '$email' AND id = '$id'";
    $result = mysqli_query($con, $query);   
    $row = mysqli_fetch_assoc($result);
    $opening = $row['opening'];
    $purchase = $row['purchase'];
    $closing = $row['closing'];
    $final = $row['profit'];
}
elseif($status=="2"){
    $query = "UPDATE daily SET closing = '$amount', date = '$date' WHERE email = '$email' AND id = '$id'";
    $result = mysqli_query($con,$query);

    $query = "SELECT * FROM daily WHERE email = '$email' AND id = '$id'";
    $result = mysqli_query($con, $query);   
    $row = mysqli_fetch_assoc($result);
    $opening = $row['opening'];
    $purchase = $row['purchase'];
    $closing = $row['closing'];
    $item = $row['item'];
    $final = $opening + $purchase - $closing;

    $query = "UPDATE daily SET profit = '$final', date = '$date' WHERE email = '$email' AND id = '$id'";
    $result = mysqli_query($con,$query);
    $query = "INSERT INTO dailyhistory (id,opening,purchase,closing,profit,date,email) VALUES('$id','$opening','$purchase','$closing','$final','$date','$email')";
    $result = mysqli_query($con,$query);

}
$td = "$opening".".$purchase".".$closing".".$final";
echo $td;
?>