<?php
    require('db.php');
    require('auth_session.php');
    // When form submitted, check and create user session.

    if(isset($_POST['id']) && (isset($_POST['quantity']))&&(isset($_POST['price']))){
        $email = $_SESSION['email'];
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $remarks = $_POST['remarks'];
        $date = date("Y-m-d");

        // $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);  
        $displayQuery = "SELECT * FROM details WHERE email = '$email' AND sale_id = '$id'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_assoc($displayResult);
        $product = $displayRows['item'];  
        if($remarks!=""){
            $query = "INSERT into `salereturn` (id, product, date, price, email,quantity,remarks)
            VALUES ('$id', '$product', '$date', '$price','$email', '$quantity','$remarks')";
            $result = mysqli_query($con, $query);
        }
        else{
            $query = "INSERT into `salereturn` (id, product,price ,date, email,quantity)
            VALUES ('$id', '$product','$price', '$date', '$email', '$quantity')";
            $result = mysqli_query($con, $query);
        }
       

    
        $displayQuery = "SELECT * FROM stocks WHERE email = '$email' AND stocks_id = '$id'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_assoc($displayResult);
        $getQuantity = $displayRows['quantity'];
        $updatedQuantity = $getQuantity + (int) $quantity;

        $query = "UPDATE stocks SET quantity = '$updatedQuantity' WHERE email = '$email' AND stocks_id = '$id'";
        $result = mysqli_query($con, $query) or die(mysql_error());
    }

         
?>