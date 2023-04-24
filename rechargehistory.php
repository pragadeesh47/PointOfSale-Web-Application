<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$btn = $_POST['btn'];
if($btn=="0"){
    $id = $_POST['id'];
    $number = $_POST['number'];
    $amount = $_POST['amount'];
    $balance = $_POST['balance']; 
    $newBalance = $_POST['newBalance'];   
    $date = date("Y-m-d");

    $query = "SELECT * FROM networks WHERE id = '$id' AND email = '$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $network = $row['network'];
    $status = $row['type'];
    if($newBalance==""){
    $query = "INSERT INTO rechargehistory (id,network, number, date,email,amount,balance, status)
     VALUES('$id','$network','$number', '$date','$email', '$amount', '$balance','$status')";
     $result = mysqli_query($con, $query);
    }
    else{
        $commission = $newBalance + $amount - $balance; 
        $query = "INSERT INTO rechargehistory (id,network, number, date,email,amount,balance, status,newbalance,commission)
        VALUES('$id','$network','$number', '$date','$email', '$amount', '$balance','$status', '$newBalance', $commission)";
        $result = mysqli_query($con, $query);
    }
}
else if($btn=="1"){
    $id = $_POST['id'];
    $number = $_POST['number'];
    $amount = $_POST['amount'];
    $balance = $_POST['balance'];  
    $newBalance = $_POST['newBalance'];   
    $date = date("Y-m-d");

    $query = "SELECT * FROM networks WHERE id = '$id' AND email = '$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $network = $row['network'];
    $status = $row['type'];
    if($newBalance==""){
    $query = "INSERT INTO rechargehistory (id,network, number, date,email,amount,balance,status)
     VALUES('$id','$network','$number', '$date','$email', '$amount', '$balance','$status')";
     $result = mysqli_query($con, $query);
    }
else{
    $commission = $newBalance + $amount - $balance; 
    $query = "INSERT INTO rechargehistory (id,network, number, date,email,amount,balance,status,newbalance, commission)
    VALUES('$id','$network','$number', '$date','$email', '$amount', '$balance','$status', '$newBalance','$commission')";
    $result = mysqli_query($con, $query);
}
}
else if($btn=="2"){
    $id = $_POST['id'];
    $number = $_POST['number'];
    $amount = $_POST['amount'];
    $balance = $_POST['balance'];  
    $newBalance = $_POST['newBalance'];   
    $date = date("Y-m-d");

    $query = "SELECT * FROM networks WHERE id = '$id' AND email = '$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $network = $row['network'];
    $status = $row['type'];
    if($newBalance==""){
    $query = "INSERT INTO rechargehistory (id,network, number, date,email,amount,balance,status)
     VALUES('$id','$network','$number', '$date','$email', '$amount', '$balance','$status')";
     $result = mysqli_query($con, $query);
    }
    else{
    $commission = $newBalance + $amount - $balance; 
        $query = "INSERT INTO rechargehistory (id,network, number, date,email,amount,balance,status,newbalance, commission)
        VALUES('$id','$network','$number', '$date','$email', '$amount', '$balance','$status','$newBalance','$commission')";
        $result = mysqli_query($con, $query);   
    }
}
?>