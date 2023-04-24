<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
    <script src=
    "https://smtpjs.com/v3/smtp.js">
  </script>
  <style>
    body{
        margin:0;
    padding:0;

    }

.login-container{
    display: flex;
    flex-direction: row;
    align-items : center;
    justify-content : center;
    margin:0;
    padding:0;
    background:white;

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
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['shopname'])) {
        // removes backslashes
        $shopname = stripslashes($_REQUEST['shopname']);
        //escapes special characters in a string
        $shopname = mysqli_real_escape_string($con, $shopname);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $address = stripslashes($_REQUEST['address']);
        $address = mysqli_real_escape_string($con, $address);
        $pincode = stripslashes($_REQUEST['pincode']);
        $pincode = mysqli_real_escape_string($con, $pincode);
        $mobile = stripslashes($_REQUEST['mobile']);
        $mobile = mysqli_real_escape_string($con, $mobile);
        $userID = strtotime("now");

        // $create_datetime = date("Y-m-d H:i:s");

        $query = "SELECT * FROM admin WHERE email = '$email' OR mobile = '$mobile'";
        $result = mysqli_query($con,$query);
        $row  = mysqli_num_rows($result);

        $query = "SELECT * FROM users WHERE email = '$email' OR mobile = '$mobile'";
        $result = mysqli_query($con,$query);
        $rows  = mysqli_num_rows($result);
        if($row==1 || $rows==1){
            if($rows==1){
                echo "<div class='form'>
                <h3>You are already registered.Try to login and use.</h3><br/>
                <p class='link'>Click here to <a href='login.php'>Login</a></p>
                </div>";
            }
            elseif($row==1){
                echo "<div class='form'>
                <h3>You are already requested to register. Please wait to accept your request.</h3><br/>
                <p class='link'>Click here to <a href='login.php'>Login</a></p>
                </div>";
            }
         
        }
        else{
            $query    = "INSERT into `admin` (shopname, password, email,mobile,address,pincode,user_id)
            VALUES ('$shopname', '$password', '$email','$mobile','$address','$pincode','$userID')";
            $result   = mysqli_query($con, $query);
            if ($result) {
              ?>
              <script>
              localStorage.setItem('srgplname', '<?php echo $shopname;?>');  
              localStorage.setItem('srgplmail', '<?php echo $email;?>');
              </script>
              <?php
                echo "<script>
                  location.href = 'regmail.html';
                </script>";
                     
            } else {
                echo "<div class='form'>
                      <h3>Required fields are missing.</h3><br/>
                      <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                      </div>";
            }
        }
      
       
    } else {
?>

<div class="login-container">
    
<div class = "img">
<img src="logo.png" alt="Logo">
</div>
<div class = "form-container">
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="shopname" placeholder="Shop Name" required />
        <input type="text" class="login-input" name="email" placeholder="Email Address" required>
        <input type="text" class="login-input" name="mobile" placeholder="Mobile" required>
        <input type="text" class="login-input" name="address" placeholder="Address" required>
        <input type="text" class="login-input" name="pincode" placeholder="Pincode" required>
        <input type="password" class="login-input" name="password" placeholder="Password" required>
        <input type="submit" name="submit" id="submit"  value="Register" class="login-button">
        <p class="link">Already have an account? <a href="login.php">Login here</a></p>
    </form>
    </div>
    </div>

<?php
    }
?>

 

</body>
</html>
