<?php

require("db.php");
require("auth_session.php");


$amount= "";
$expense = 0;
$purchase = 0;
$service = 0;
$saleToday = 0;
$serviceToday = 0;
$returnToday = 0;
$expenseToday = 0;
$purchaseToday = 0;
$creditsInToday = 0;
$creditsOutToday = 0;
$cashInHand = 0;
$saleReturn = 0;
$recharge = 0;
$upiAmount = 0;
$hand = 0;
$bank = 0;

$email = $_SESSION['email']; 
$date = date("Y-m-d");


$saleQuery = "SELECT * FROM `detailshistory` WHERE email='$email' and saleOrpurchase = 'sale' AND date = '$date'";
$saleResult = mysqli_query($con, $saleQuery) or die(mysql_error());
$saleRows = mysqli_fetch_all($saleResult, MYSQLI_ASSOC);

foreach ($saleRows as $row) {
   $saleToday += $row['price'];
}

$saleQuery = "SELECT * FROM `detailshistory` WHERE email='$email' and saleOrpurchase = 'expense' AND date = '$date'";
$saleResult = mysqli_query($con, $saleQuery) or die(mysql_error());
$saleRows = mysqli_fetch_all($saleResult, MYSQLI_ASSOC);

foreach ($saleRows as $row) {
   $expenseToday += $row['price'];
}

$saleQuery = "SELECT * FROM `purchasehistory` WHERE email='$email' AND entryDate = '$date'";
$saleResult = mysqli_query($con, $saleQuery) or die(mysql_error());
$saleRows = mysqli_fetch_all($saleResult, MYSQLI_ASSOC);

foreach ($saleRows as $row) {
   $purchaseToday += $row['paid'];
}

$saleQuery = "SELECT * FROM `servicehistory` WHERE email='$email' AND date = '$date'";
$saleResult = mysqli_query($con, $saleQuery) or die(mysql_error());
$saleRows = mysqli_fetch_all($saleResult, MYSQLI_ASSOC);

foreach ($saleRows as $row) {
   $serviceToday += $row['paid'];
}

$saleQuery = "SELECT * FROM `servicehistory` WHERE email='$email' AND date = '$date'";
$saleResult = mysqli_query($con, $saleQuery) or die(mysql_error());
$saleRows = mysqli_fetch_all($saleResult, MYSQLI_ASSOC);

foreach ($saleRows as $row) {
   $serviceToday -= $row['return_amount'];
}


$saleQuery = "SELECT * FROM `customerhistory` WHERE email='$email' AND date = '$date'";
$saleResult = mysqli_query($con, $saleQuery) or die(mysql_error());
$saleRows = mysqli_fetch_all($saleResult, MYSQLI_ASSOC);

foreach ($saleRows as $row) {
   $creditsInToday += $row['payment'];
}

$saleQuery = "SELECT * FROM `customerhistory` WHERE email='$email' AND date = '$date'";
$saleResult = mysqli_query($con, $saleQuery) or die(mysql_error());
$saleRows = mysqli_fetch_all($saleResult, MYSQLI_ASSOC);

foreach ($saleRows as $row) {
   $creditsOutToday += $row['credit'];
}
$saleQuery = "SELECT * FROM `cashinhand` WHERE email='$email' AND date = '$date'";
$saleResult = mysqli_query($con, $saleQuery) or die(mysql_error());
$saleRows = mysqli_fetch_all($saleResult, MYSQLI_ASSOC);

foreach ($saleRows as $row) {
   $cashInHand += $row['cash'];
}

$saleQuery = "SELECT * FROM `salereturn` WHERE email='$email' AND date = '$date'";
$saleResult = mysqli_query($con, $saleQuery) or die(mysql_error());
$saleRows = mysqli_fetch_all($saleResult, MYSQLI_ASSOC);

foreach ($saleRows as $row) {
   $saleReturn += $row['price'];
}

$saleQuery = "SELECT * FROM `rechargehistory` WHERE email='$email' AND date = '$date'";
$saleResult = mysqli_query($con, $saleQuery) or die(mysql_error());
$saleRows = mysqli_fetch_all($saleResult, MYSQLI_ASSOC);

foreach ($saleRows as $row) {
   $recharge += $row['amount'];
}

$saleQuery = "SELECT * FROM `withdrawhistory` WHERE email='$email' AND date = '$date'";
$saleResult = mysqli_query($con, $saleQuery) or die(mysql_error());
$saleRows = mysqli_fetch_all($saleResult, MYSQLI_ASSOC);

foreach ($saleRows as $row) {
   $upiAmount += $row['amount'];
   if($row['way']==0){
      $bank += $row['commission'];
   }
   else{
      $hand = $row['commission'];
   }
}




$total = $saleToday - $expenseToday + $serviceToday - $purchaseToday + $creditsInToday - $creditsOutToday + $cashInHand - $saleReturn + $recharge + $hand - $bank - $upiAmount;

$amount.="$saleToday".".$expenseToday".".$serviceToday".".$purchaseToday".".$creditsInToday".".$creditsOutToday".".$total".".$cashInHand".".$saleReturn".".$recharge".".$upiAmount".".$hand".".$bank";
echo $amount;
?>