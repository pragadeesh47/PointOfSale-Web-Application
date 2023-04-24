<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$itemId = $_POST['itemID'];
$query = "SELECT * FROM details WHERE email ='$email' AND sale_id='$itemId'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$res = (int) $_POST['quantity'] * $row['rate'];

echo $res;
?>