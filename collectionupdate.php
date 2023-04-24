
<?php
    require('db.php');
    require('auth_session.php');
    $email = $_SESSION['email'];

    // When form submitted, insert values into the database.
if (isset($_POST['amount']) && isset($_POST['amountType'])) {
    $type = stripslashes($_REQUEST['amountType']);
    //escapes special characters in a string
    $type = mysqli_real_escape_string($con, $type);
    $amount = stripslashes($_REQUEST['amount']);
    //escapes special characters in a string
    $amount = mysqli_real_escape_string($con, $amount);

    $amountType = stripslashes($_REQUEST['amountType']);
    //escapes special characters in a string
    $amountType = mysqli_real_escape_string($con, $amountType);

    $customerID = stripslashes($_REQUEST['id']);
    //escapes special characters in a string
    $customerID = mysqli_real_escape_string($con, $customerID);
    $remarks = stripslashes($_REQUEST['remarks']);
    //escapes special characters in a string
    $remarks = mysqli_real_escape_string($con, $remarks);
    
    $date = date("Y-m-d");


    $displayQuery = "SELECT * FROM customers WHERE email = '$email' AND customer_ID = '$customerID'";
    $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
    $displayRow = mysqli_fetch_assoc($displayResult, );
    $getBalanceAmount = $displayRow['customer_balance'];

    $flag = false;
    // removes backslashes
    if($amountType == "0"){
        $totalBalanceAmount = $getBalanceAmount - (int) $amount;
        if($totalBalanceAmount<0){
            $flag = true;
        }
        else{
        if($remarks!=""){
            $historyQuery = "INSERT into `customerhistory` (email, customer_ID, payment, date,remarks, balance)
            VALUES ('$email', '$customerID', '$amount', '$date','$remarks','$totalBalanceAmount')";
            $historyResult = mysqli_query($con, $historyQuery);
        }
        else{
            $historyQuery = "INSERT into `customerhistory` (email, customer_ID, payment, date, balance)
            VALUES ('$email', '$customerID', '$amount', '$date', '$totalBalanceAmount')";
            $historyResult = mysqli_query($con, $historyQuery);
        }
    }

    }
    else{
        $totalBalanceAmount = $getBalanceAmount + (int) $amount;
        if($remarks!=""){
            $historyQuery = "INSERT into `customerhistory` (email, customer_ID, credit, date,remarks, balance)
            VALUES ('$email', '$customerID', '$amount', '$date','$remarks','$totalBalanceAmount')";
            $historyResult = mysqli_query($con, $historyQuery);
        }
        else{
            $historyQuery = "INSERT into `customerhistory` (email, customer_ID, credit, date, balance)
            VALUES ('$email', '$customerID', '$amount', '$date','$totalBalanceAmount')";
            $historyResult = mysqli_query($con, $historyQuery);
        }

    }

    
   
    if($flag){
        echo -1;
    }
    else{
        $date = date("Y-m-d");

        $query = " UPDATE customers
        SET customer_balance = '$totalBalanceAmount'
        WHERE email = '$email' AND customer_ID = '$customerID'";
        $result = mysqli_query($con, $query);
    
        $displayQuery = "SELECT * FROM customers WHERE email = '$email' AND customer_ID = '$customerID'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_assoc($displayResult);
        $balance = $displayRows['customer_balance'];
    
    echo $balance;
    }
    // $getBalanceAmount = $displayRow['customer_balance'];


    # UPDATE CUSTOMER HISTORY
   


//     $td = "<thead><tr>
//     <th>SERIAL NO</th>
//     <th>CUSTOMER ID</th>
//     <th>CUSTOMER NAME</th>
//     <th>MOBILE</th>
//     <th>PARTICULAR</th>
//     <th>BALANCE</th>
//     <th>UPDATE</th>
//     <th>HISTORY</th>
// </tr></thead><tbody>";
// $serial_no = 1;

//     foreach($displayRows as $displayRow){
//     $td .= "<tr  id = '".$displayRow['customer_ID']."' >
//         <td>" . $serial_no++ . "</td>
//         <td>" . $displayRow['customer_ID'] . "</td>
//         <td>" . $displayRow['customer_name']. "</td>
//         <td>" . $displayRow['customer_mobile']. "</td>
//         <td>" . $displayRow['customer_particulars']. "</td>
//         <td  id = '".$displayRow['customer_ID']."'>" . $displayRow['customer_balance']. "</td>
//         <td><button class = 'coll-btn' data-id = '".$displayRow['customer_ID']."'>UPDATE</button></td>
//         <td><button class = 'history-btn' data-id = '".$displayRow['customer_ID']."'>HISTORY</button></td>
//     </tr>";
//     }
//     $td .= "</tbody>";
//     echo $td;
}
?>
