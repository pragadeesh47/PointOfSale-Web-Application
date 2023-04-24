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

        # RETRIEVE DATA
        $displayQuery = "SELECT * FROM details WHERE email = '$email' AND sale_id = '$id'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_assoc($displayResult);
        $getItem = $displayRows['item'];
        $getQuantity =  $displayRows['quantity'];
        $getPrice = $displayRows['price'];

        $finalQuantity = $quantity + $getQuantity;
        $finalPrice = $price + $getPrice;
        $date = date("Y-m-d");


        $query = "UPDATE details SET quantity = '$finalQuantity', price = '$finalPrice' WHERE email = '$email' AND sale_id = '$id'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        // $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);    
        if($remarks!=""){
            $query = "INSERT into `detailshistory` (item, price, saleOrpurchase, date, email,sale_id,quantity,remarks)
            VALUES ('$getItem', '$price', 'sale', '$date', '$email','$id', '$quantity','$remarks')";
            $result = mysqli_query($con, $query);
        }
        else{
            $query = "INSERT into `detailshistory` (item, price, saleOrpurchase, date, email,sale_id,quantity)
            VALUES ('$getItem', '$price', 'sale', '$date', '$email','$id', '$quantity')";
            $result = mysqli_query($con, $query);
        }
       

    
        $displayQuery = "SELECT * FROM stocks WHERE email = '$email' AND stocks_id = '$id'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_assoc($displayResult);
        $getQuantity = $displayRows['quantity'];
        $updatedQuantity = $getQuantity - (int) $quantity;

        $query = "UPDATE stocks SET quantity = '$updatedQuantity' WHERE email = '$email' AND stocks_id = '$id'";
        $result = mysqli_query($con, $query) or die(mysql_error());
    }

         
?>