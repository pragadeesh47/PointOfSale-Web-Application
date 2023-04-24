<?php
require("auth_session.php");
require("db.php");
$email = $_SESSION['email'];
$id = $_POST['id'];
$query = "DELETE FROM details WHERE email = '$email' AND sale_id = '$id'";
$result = mysqli_query($con, $query);
?>