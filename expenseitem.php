<?php
require('db.php');
require('auth_session.php');
    // When form submitted, check and create user session.

 
$email = $_SESSION['email'];
$query = "SELECT * FROM Details WHERE email = '$email' AND saleOrpurchase = 'expense'";
$result = mysqli_query($con, $query) or die(mysql_error());
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach($rows as $row){
    $td .= "
    <option value = '".$row['sale_id']."'>".$row['item']."</option>
    ";
}

echo $td;
  
?>