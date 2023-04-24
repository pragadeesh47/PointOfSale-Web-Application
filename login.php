<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        .login-container{
    display: flex;
    flex-direction: row;
    align-items : center;
    justify-content : center;
    width:100%;
    margin:0;
    padding:0;
}
body{
    display: flex;
    justify-content: center;
    text-align: center;
    height: 100vh;
    margin:0;
    padding:0;

}

.login-container .img{
  display:flex;
    align-items:center;
    justify-content:center;
}
.login-container .img img{
    margin: auto;
    overflow:hidden;
   
}
.login-container div {
    /* width:400px;
    height:500px; */
    width:100%;
    height:100%;
    display:flex;
    justify-content:center;
    align-items:center;
}
.login-container{
    background:url("lgback.jpg");
    background-size:cover;
}

    </style>
</head>
<body>
<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE email='$email'
                     AND password='$password'";
        $result = mysqli_query($con, $query);
        $rows = mysqli_num_rows($result);
        $query    = "SELECT * FROM `admin` WHERE email='$email'
                     AND password='$password'";
        $result = mysqli_query($con, $query);
        $row = mysqli_num_rows($result);
        $res = mysqli_fetch_array($result);
        if($row==1){
            if($res['status']==0){
            echo "<div class='form'>
            <h3>Still your request was not accepted. Wait for our response.</h3><br/>
            <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
            </div>";
        }
else{
    $_SESSION['email'] = $email;

    header("Location: recharge.html");
}
        }
        elseif($rows == 1) {
            $_SESSION['email'] = $email;

            header("Location: recharge.html");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
<div class="login-container">
    
<div class = "img">
<img src="logo.png" alt="Logo">
</div>
<div class = "form-container">

    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input email" name="email" placeholder="email" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Don't have an account? <a href="registration.php">Registration Now</a></p>
  </form>
  </div>
</div>

<?php
    }
?>

    <script>
        document.querySelector(".login-button").onclick = () =>{
            localStorage.setItem("srgpl",document.querySelector(".email").value);
        }
    </script>
</body>
</html>
