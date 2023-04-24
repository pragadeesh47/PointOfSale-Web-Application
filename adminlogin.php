<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Admin</title>
    <link rel="stylesheet" href="style.css"/>

    <style>
        body{
            background-color: white;

        }
        .login-container{
    display: flex;
    flex-direction: row;
    align-items : center;
    justify-content : center;
}

.login-container .img{
  display:flex;
    align-items:center;
    justify-content:center;
}
.login-container .img img{
    margin: auto;
    background: white;
    overflow:hidden;
   
}
.login-container div {
    width:400px;
    height:500px;
    background : white;
}

    </style>
</head>
<body>
<?php
    
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        // Check user is exist in the database
        // $query    = "SELECT * FROM `users` WHERE email='$email'
        //              AND password='$password'";
        // $result = mysqli_query($con, $query);
        // $rows = mysqli_num_rows($result);
        if ($email == "admin@srgpl.com" && $password == "admin@srgpl") {
            $_SESSION['admin'] = $email;
            // Redirect to user dashboard page
            header("Location: admin.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='adminlogin.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>

<div class="login-container">
    
<div class = "img">
<img src="logo.png" alt="Logo">
</div>
<div>
    <form class="form" method="post" name="login">
        <h1 class="login-title">ADMIN LOGIN</h1>
        <input type="text" class="login-input" name="email" placeholder="email" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Not an admin - <a href="login.php">Login here</a></p>

  </form>
    </div>
    </div>
<?php
    }
?>
</body>
</html>
