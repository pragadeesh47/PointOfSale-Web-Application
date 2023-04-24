
<?php
    require('db.php');
    require('auth_session.php');
    $email = $_SESSION['email'];

    // When form submitted, insert values into the database.
    if (isset($_POST['id'])) {
        // removes backslashes
        $id = stripslashes($_REQUEST['id']);
        //escapes special characters in a string
        $id = mysqli_real_escape_string($con, $id);
        $particular    = stripslashes($_REQUEST['particular']);
        $particular    = mysqli_real_escape_string($con, $particular);
        $amount = stripslashes($_REQUEST['amount']);
        $amount = mysqli_real_escape_string($con, $amount);
       $date = $_POST['date'];
       $entryDate = date("Y-m-d");

       
        $status = "unpaid";

        $displayQuery = "SELECT * FROM purchase WHERE email = '$email' AND shop_id = '$id'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRow = mysqli_fetch_assoc($displayResult);

    $shop = $displayRow['shop'];
    $getPrice = $displayRow['price'];
    $price = $getPrice + (int) $amount;

    $query = "UPDATE purchase SET status = '$status', price = '$price', particulars = '$particular',date = '$date', entryDate = '$entryDate' WHERE email = '$email' AND shop_id = '$id'";
    $result = mysqli_query($con, $query);
    
        // $create_datetime = date("Y-m-d H:i:s");
        # NEW CUSTOMER INSERTION 
        $query    = "INSERT into `purchasehistory` (shop_name, unpaid, status, email, shop_id,date,balance,particular,entryDate)
        VALUES ('$shop', '$amount','$status','$email', '$id','$date','$price','$particular','$entryDate')";
        $result   = mysqli_query($con, $query);


        $displayQuery = "SELECT * FROM purchase WHERE email = '$email' AND shop_id = '$id'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_assoc($displayResult);
        $pt = $displayRows['particulars'];
        $dt = $displayRows['date'];
        $amount = $displayRows['price'];
        $status = $displayRows['status'];
        $td = "$pt".".$dt".".$amount".".$status";
       
echo $td;
    } 
    
?>
