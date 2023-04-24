<?php
    session_start();
    // Destroy session
    session_destroy();
        // Redirecting To Home Page
    header("Location: login.php");
    
?>
