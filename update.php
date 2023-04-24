<?php
    
    require('db.php');
    require('auth_session.php');
    // When form submitted, insert values into the database.
    if (isset($_POST['item']) && isset($_POST['rate'])) {
        // removes backslashes
        $item = stripslashes($_REQUEST['item']);
        //escapes special characters in a string
        $item = mysqli_real_escape_string($con, $item);
        
        $rate = stripslashes($_REQUEST['rate']);
        $rate = mysqli_real_escape_string($con, $rate);
        $date = date("Y-m-d");
        $saleOrPurchase = "sale";
        $email = $_SESSION['email'];

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
        //Use array anywhere outside the foreach loop
        
    
        // $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `details` (item, saleOrpurchase, date, email,sale_id,rate)
                     VALUES ('$item', '$saleOrPurchase', '$date', '$email','$sale_ID','$rate')";
        $result   = mysqli_query($con, $query);
        // $query    = "INSERT into `detailshistory` (item, saleOrpurchase, date, email,sale_id)
        // VALUES ('$item', '$saleOrPurchase', '$date', '$email','$sale_ID')";
        // $result   = mysqli_query($con, $query);
        echo $sale_ID; 
   
    } 

?>