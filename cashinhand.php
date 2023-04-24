<?php
    
    require('db.php');
    require('auth_session.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['cash'])) {
        $cash = stripslashes($_REQUEST['cash']);
        $cash = mysqli_real_escape_string($con, $cash);
        $date = date("Y-m-d");
        $email = $_SESSION['email'];
        // $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `cashinhand` (cash, email, date)
                     VALUES ('$cash', '$email', '$date')";
        $result   = mysqli_query($con, $query);
        
    } 
?>