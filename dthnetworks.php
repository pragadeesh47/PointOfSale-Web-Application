<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$query = "SELECT * FROM networks WHERE email = '$email' AND type = 1";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);


foreach($rows as $row){
    $td .= "
    <option value = '".$row['id']."'>".$row['network']."</option>
    ";
}

echo $td;
  
?>