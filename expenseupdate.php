<?php
    
    require('db.php');
    require('auth_session.php');
    $email = $_SESSION['email'];
    // When form submitted, insert values into the database.
    if (isset($_POST['item'])) {
        // removes backslashes
        $item = stripslashes($_REQUEST['item']);
        //escapes special characters in a string
        $item = mysqli_real_escape_string($con, $item);
        // $price = stripslashes($_REQUEST['price']);
        // $price = mysqli_real_escape_string($con, $price);
        $date = date("Y-m-d");
        $saleOrPurchase = "expense";
        
        $createId  = "SELECT sale_id FROM details
        UNION ALL
        SELECT shop_id FROM purchase 
        UNION ALL
        SELECT customer_id FROM service
        UNION ALL
        SELECT customer_ID FROM customers
        UNION ALL
        SELECT stocks_id FROM stocks
        UNION ALL
        SELECT order_id FROM orders
        UNION ALL
        SELECT id FROM daily
        UNION ALL
        SELECT customer_id FROM customerdetails
        UNION ALL
SELECT id FROM networks
UNION ALL
        SELECT id FROM withdraw
        ";
        $resultId = mysqli_query($con, $createId);
        $idRows = mysqli_fetch_all($resultId, MYSQLI_ASSOC);
        $numOfRows = mysqli_num_rows($resultId);
        
        $newArray=array(); // declare array before foreach loop  
        foreach($idRows as $row) 
        {
        $newArray[]=$row['sale_id']; 
        }

        if($numOfRows==0){
            $sale_ID=1001;
        }
        else{
            $sale_ID = 1001;
          for($i=0;$i<$numOfRows;$i++){
            if(in_array($sale_ID,$newArray)){
                $sale_ID++;
            }
            else{
                break;
            }
          }
        }

        // $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `details` (item, saleOrpurchase, date, email,sale_id)
                     VALUES ('$item', '$saleOrPurchase', '$date', '$email','$sale_ID')";
        $result   = mysqli_query($con, $query);
       
        // $query = "INSERT into `detailshistory` (item, price, saleOrpurchase, date, email,sale_id)
        // VALUES ('$item', '$price', '$saleOrPurchase', '$date', '$email','$sale_ID')";
        // $result = mysqli_query($con, $query);

    } 
elseif(isset($_POST['id']) && isset($_POST['updatePrice'])){

    $id = $_POST['id'];
    $updatePrice = $_POST['updatePrice'];

    $query = "SELECT * FROM details WHERE email='$email' AND sale_id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $price = $row['price'];
    $remarks = $_POST['remarks'];
    $updatedPrice = (int) $updatePrice + $row['price'];
    $item = $row['item'];
    $date = date("Y-m-d");

    $query = "UPDATE details SET price = '$updatedPrice' WHERE email = '$email' AND sale_id = '$id'";
    $result   = mysqli_query($con, $query);
    if($remarks!=""){
        $query = "INSERT into `detailshistory` (item, price, saleOrpurchase, date, email,sale_id,remarks)
        VALUES ('$item', '$updatePrice', 'expense', '$date', '$email','$id','$remarks')";
        $result = mysqli_query($con, $query);
    }
    else{
        $query = "INSERT into `detailshistory` (item, price, saleOrpurchase, date, email,sale_id)
        VALUES ('$item', '$updatePrice', 'expense', '$date', '$email','$id')";
        $result = mysqli_query($con, $query);
    }
  


    }
?>