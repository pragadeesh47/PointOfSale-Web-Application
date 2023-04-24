
<?php
    require('db.php');
    require('auth_session.php');
    $email = $_SESSION['email'];

    // When form submitted, insert values into the database.
if (isset($_POST['statusType'])) {
    $status = stripslashes($_REQUEST['statusType']);
    //escapes special characters in a string
    $status = mysqli_real_escape_string($con, $status);
    $shopID = stripslashes($_REQUEST['id']);
    //escapes special characters in a string
    $shopID = mysqli_real_escape_string($con, $shopID);
    $amount = stripslashes($_REQUEST['amount']);
    //escapes special characters in a string
    $amount = mysqli_real_escape_string($con, $amount);
    
    $date = date("Y-m-d");
    $userAmount = $amount;

    if ($status == "0") {
        $displayQuery = "SELECT * FROM purchase WHERE email = '$email' AND shop_id = '$shopID'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRow = mysqli_fetch_assoc($displayResult);
        $getAmount = $displayRow['price'];
        $amount = $getAmount - (int) $amount;
        $shop = $displayRow['shop'];
        $flag  = false;
        if($amount<0){
            $flag = true;
        }
        else{


        if ($amount == 0) {
            $status = "paid";
            $query = " UPDATE purchase
            SET status = '$status', price = '$amount'
            WHERE email = '$email' AND shop_id = '$shopID'";
            $result = mysqli_query($con, $query);

            $query    = "INSERT into `purchasehistory` (shop_name, paid, status, email, shop_id,date,balance)
            VALUES ('$shop', '$userAmount','$status','$email', '$shopID','$date','$amount')";
            $result   = mysqli_query($con, $query);

        } else {
            $status = "unpaid";
            $query = " UPDATE purchase
            SET status = '$status', price = '$amount'
            WHERE email = '$email' AND shop_id = '$shopID'";
            $result = mysqli_query($con, $query);
            $status = "paid";
            $query    = "INSERT into `purchasehistory` (shop_name, paid, status, email, shop_id,date,balance)
            VALUES ('$shop', '$userAmount','$status','$email', '$shopID','$date','$amount')";
            $result   = mysqli_query($con, $query);
        }
    }
}

    $displayQuery = "SELECT * FROM purchase WHERE email = '$email' AND shop_id = '$shopID'";
    $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
    $displayRows = mysqli_fetch_assoc($displayResult);
    $balance = $displayRows['price'];
    $status = $displayRows['status'];
    $balance .=".$status";

    if($flag){
    echo "-1".".0";
    // $getBalanceAmount = $displayRow['customer_balance'];
    }
    else{
        echo $balance;
    }

    # UPDATE CUSTOMER HISTORY
   


//     $td = "<thead><tr>
//     <th>SERIAL NO</th>
//     <th>SHOP ID</th>
//     <th>SHOP NAME</th>
//     <th>PARTICULAR</th>
//     <th>PRICE</th>
//     <th>STATUS</th>
//     <th>UPDATE</th>
//     <th>HISTORY</th>
// </tr><thead><tbody>";
// $serial_no = 1;
// foreach ($displayRows as $displayRow) {
//     $td .= "<tr>
//         <td>" . $serial_no++ . "</td>
//         <td>" . $displayRow['shop_id'] . "</td>
//         <td>" . $displayRow['shop'] . "</td>
//         <td>" . $displayRow['particulars'] . "</td>
//         <td>" . $displayRow['price'] . "</td>
//         <td>" . $displayRow['status'] . "</td>
//         <td><button class='status-btn' data-id='" . $displayRow['shop_id'] . "'>UPDATE</button></td>
//         <td><button class='history-btn' data-id='" . $displayRow['shop_id'] . "'>HISTORY</button></td>

//     </tr>";
// }

// $td.="</tbody>";
// echo $td;
}
?>
