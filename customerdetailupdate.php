<?php 
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$remarks = $_POST['remarks'];
$id = $_POST['id'];
$query = "UPDATE customerdetails SET remarks = '$remarks' WHERE customer_id = '$id' AND email = '$email'";
$result = mysqli_query($con, $query);
$date = date("Y-m-d");
$nameQuery = "SELECT * FROM customerdetails WHERE customer_id = '$id' AND email = '$email'";
$nameResult = mysqli_query($con, $nameQuery);
$nameRow = mysqli_fetch_assoc($nameResult);
$remarks = $nameRow['remarks'];
$name = $nameRow['name'];
$query = "INSERT INTO customerdetailshistory ( name, email, customer_id,date,remarks) VALUES('$name','$email','$id','$date','$remarks')";
$result = mysqli_query($con, $query);
echo $remarks ;
?>