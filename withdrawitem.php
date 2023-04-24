<?php
require('db.php');
require('auth_session.php');
    // When form submitted, check and create user session.

 
$email = $_SESSION['email'];
$query = "SELECT * FROM withdraw WHERE email = '$email'";
$result = mysqli_query($con, $query) or die(mysql_error());
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach($rows as $row){
    $td .= "
    <option value = '".$row['id']."'>".$row['name']."</option>
    ";
}

echo $td;
  
?>