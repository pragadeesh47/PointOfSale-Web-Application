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
        SELECT id FROM withdraw
        UNION ALL
SELECT id FROM networks
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
        $query    = "INSERT into `withdraw` (id, name, email)
                     VALUES ('$sale_ID', '$item', '$email')";
        $result   = mysqli_query($con, $query);
       
        // $query = "INSERT into `detailshistory` (item, price, saleOrpurchase, date, email,sale_id)
        // VALUES ('$item', '$price', '$saleOrPurchase', '$date', '$email','$sale_ID')";
        // $result = mysqli_query($con, $query);
echo "success";
    } 
elseif(isset($_POST['id']) && isset($_POST['amount'])){

    $id = $_POST['id'];
    $amount = $_POST['amount'];
    $commission = $_POST['commission'];

    $query = "SELECT * FROM withdraw WHERE email='$email' AND id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $item = $row['name'];
    $date = date("Y-m-d");
    $remarks = $_POST['remarks'];
    $way = $_POST['way'];
    
    if($remarks!=""){
        $query = "INSERT into `withdrawhistory` (name, amount,  commission, date, email,id,remarks,way)
        VALUES ('$item', $amount, '$commission', '$date', '$email','$id','$remarks','$way')";
        $result = mysqli_query($con, $query);
    }
    else{
        $query = "INSERT into `withdrawhistory` (name, amount,  commission, date, email,id,way)
        VALUES ('$item', $amount, '$commission', '$date', '$email','$id','$way')";
        $result = mysqli_query($con, $query);    
    }
    echo "success";
    }
?>