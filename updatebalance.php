<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$id = $_POST['id'];
$final = $_POST['final'];
if(isset($final)){
    $query = "SELECT * FROM service WHERE email = '$email' AND customer_id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $balance = (int) $final - $row['advance_amount'];
    echo $balance;
}

?>