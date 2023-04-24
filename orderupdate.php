<?php 
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$id = $_POST['id'];
$status = $_POST['status'];
$remarks = $_POST['remarks'];
if($remarks!=""){
    if($status=="0"){
        $state = "Success";
        $query = "UPDATE orders SET remarks = '$remarks',status = '$state' WHERE email = '$email' AND order_id = '$id'";
        $result = mysqli_query($con, $query); 
    }
    else if($status=="1"){
        $state = "Delivered";
        $query = "UPDATE orders SET remarks = '$remarks',status = '$state' WHERE email = '$email' AND order_id = '$id'";
        $result = mysqli_query($con, $query); 
    }
    elseif($status=="2"){
        $state = "Failed";
        $query = "UPDATE orders SET remarks = '$remarks',status = '$state' WHERE email = '$email' AND order_id = '$id'";
        $result = mysqli_query($con, $query); 
    }
    elseif($status=="3"){
        $state = "Cancelled";
        $query = "UPDATE orders SET remarks = '$remarks',status = '$state' WHERE email = '$email' AND order_id = '$id'";
        $result = mysqli_query($con, $query); 
    }
}
else{
    if($status=="0"){
        $state = "Success";
        $query = "UPDATE orders SET status = '$state' WHERE email = '$email' AND order_id = '$id'";
        $result = mysqli_query($con, $query); 
    }
    else if($status=="1"){
        $state = "Delivered";
        $query = "UPDATE orders SET status = '$state' WHERE email = '$email' AND order_id = '$id'";
        $result = mysqli_query($con, $query); 
    }
    elseif($status=="2"){
        $state = "Failed";
        $query = "UPDATE orders SET status = '$state' WHERE email = '$email' AND order_id = '$id'";
        $result = mysqli_query($con, $query); 
    }
    elseif($status=="3"){
        $state = "Cancelled";
        $query = "UPDATE orders SET status = '$state' WHERE email = '$email' AND order_id = '$id'";
        $result = mysqli_query($con, $query); 
    }
}

$query = "SELECT * FROM orders WHERE email = '$email' AND order_id = '$id'";
$result  = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$remarks = $row['remarks'];
$status = $row['status'];
$final = $status.".$remarks";

echo $final;
?>