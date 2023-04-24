<?php
require("adminauth.php");
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="table.css">
    <link rel="icon" href="logo.png" sizes = 32x32 type="image/icon type">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <style>
        *{
            margin:0;
            padding:0;
        }
        header{
            background-color: dodgerblue;
            padding:20px;
            position: relative;
        }
        nav{
            text-align: center;
            font-weight: bolder;
            color : white;
        }

        
#usersList {
    border-collapse: collapse;
    /* margin: 25px 0; */
    margin: 25px auto;
    font-size: 0.9em;
    font-family: Arial, Helvetica, sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

#usersList thead tr {
    background-color: dodgerblue;
    color: #ffffff;
    text-align: left;
}

#usersList thead th {
    padding: 12px 15px;
    overflow-wrap: break-word;
    font-weight: bold;
}
#usersList tbody td{
    overflow-wrap: break-word;
    padding: 12px;

}
#usersList tbody td button{
    padding: 8px;
    border-radius:10px;
    border:none;
    color:white;
    font-weight:bold;
    cursor:pointer;

}
#usersList tbody td .upt-btn{
    background-color:green;
}

#usersList tbody td .rjt-btn{
    background-color:red;
}
#usersList tbody tr {
    border-bottom: 1px solid #dddddd;
    text-align: left;
}

#usersList tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

ul {
    list-style-type:none;
}
ul li{
    display:inline;
    margin-right:5px;
    padding: 10px;

}
ul li a{
    text-decoration:none;
    color:white;

}
nav{
    display:flex;
    justify-content:space-evenly;
}

.logout{
      display: flex;
      align-items: center;
      justify-content: center;
      position: absolute;
      right:14px;
      top:14px;
     }
     .logout img{
      margin-right: 5px;
     }
     .logout img{
  height: 25px;
  width: 25px;
}




    </style>
</head>
<body>
   <header>
    <nav>
        <p>SRGPL</p>
        <ul>
            <li><a href="admin.php" class = "link">Requests</a></li>
            <li><a href="accounts.php" class = "link">Accounts</a></li>
        </ul>
    </nav>
   </header>
   <div id = "users">
    <table id = "usersList">

    </table>
    </div>

     
<!-- LOGOUT BUTTON STARTS -->
  
<div class="logout">
    <!-- <div class="logItem">
      <a href="profile.html"><img src="profile.png" alt=""></a>
    </div> -->
    <div class="logItem">
    <a href="adminlogout.php"><img src="shutdown.png" alt=""></a>
    </div>
</div>
<!-- LOGOUT BUTTON ENDS -->


   <script>
$(document).ready(function(){
    $.ajax({
        url : "adminusers.php",
        method : "POST",
        success :  function(data){
            $("#usersList").html(data);
            console.log(data);
            $( ".upt-btn" ).each(function(index) {
    $(this).on("click", function(){
        var  id = $(this).attr("data-id");
        var status = 1;
    $.ajax({
        url:"adminaccept.php",
        method : "POST",
        data : {
            id : id,
            status : status
        },
        success : function(data){
            $('#'+id ).remove();
        }
    })
    });
});


$( ".rjt-btn" ).each(function(index) {
    $(this).on("click", function(){
        var  id = $(this).attr("data-id");
        var status = 2;
    $.ajax({
        url:"adminaccept.php",
        method : "POST",
        data : {
            id : id,
            status : status
        },
        success : function(data){
            $('#'+id ).remove();
        }
    })
    });
});
        }
    })
})


   </script>
<script src='app.js'></script>

</body>
</html>