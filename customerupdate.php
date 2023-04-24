
<?php
    require('db.php');
    require('auth_session.php');
    $email = $_SESSION['email'];

    // When form submitted, insert values into the database.
    if (isset($_REQUEST['customer-name'])) {
        // removes backslashes
        $customerName = stripslashes($_REQUEST['customer-name']);
        //escapes special characters in a string
        $customerName = mysqli_real_escape_string($con, $customerName);
        $customerMobile    = stripslashes($_REQUEST['customer-mobile']);
        $customerMobile    = mysqli_real_escape_string($con, $customerMobile);
        $customerParticular = stripslashes($_REQUEST['customer-particular']);
        $customerParticular = mysqli_real_escape_string($con, $customerParticular);
        $customerBalance = stripslashes($_REQUEST['customer-balance']);
        $customerBalance = mysqli_real_escape_string($con, $customerBalance);
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
            $customerID=1001;
        }
        else{
            $customerID = 1001;
          for($i=0;$i<$numOfRows;$i++){
            if(in_array($customerID,$newArray)){
                $customerID++;
            }
            else{
                break;
            }
          }
        }
        // $create_datetime = date("Y-m-d H:i:s");
        $mobile = (int) $customerMobile;
        $query = "SELECT * FROM customers WHERE customer_mobile = '$mobile' AND email = '$email'";
        $result = mysqli_query($con,$query);
        $row = mysqli_num_rows($result);
        if($row==1){
            echo "Mobile number already exists";
        }
        else{
        # NEW CUSTOMER INSERTION 

        $query    = "INSERT into `customers` (customer_name, customer_mobile, customer_particulars, customer_ID, customer_balance, email, date)
                     VALUES ('$customerName', '$customerMobile', '$customerParticular','$customerID','$customerBalance','$email', '$date')";
        $result   = mysqli_query($con, $query);
        $displayQuery = "SELECT * FROM customers WHERE email = '$email'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_all($displayResult, MYSQLI_ASSOC);

        # CUSTOMER HISTORY INSERTION

        $historyQuery    = "INSERT into `customerhistory` (email, customer_ID, credit, date, remarks,balance)
        VALUES ('$email', '$customerID', '$customerBalance', '$date', '$customerParticular','$customerBalance')";
        $historyResult   = mysqli_query($con, $historyQuery);

        $td = "<thead><tr>
        <th>SERIAL NO</th>
        <th>CUSTOMER ID</th>
        <th>CUSTOMER NAME</th>
        <th>MOBILE</th>
        <th>PARTICULARS</th>
        <th>BALANCE</th>
        <th>UPDATE</th>
        <th>HISTORY</th>
        <th>DELETE</th>
    </tr><thead><tbody>";
    $serial_no = 1;
        foreach($displayRows as $displayRow){
            $td .= "<tr  id = '".$displayRow['customer_ID']."' >
            <td>" . $serial_no++ . "</td>
            <td>" . $displayRow['customer_ID'] . "</td>
            <td>" . $displayRow['customer_name']. "</td>
            <td>" . $displayRow['customer_mobile']. "</td>
            <td>" . $displayRow['customer_particulars']. "</td>
            <td  class = 'balance'>" . $displayRow['customer_balance']. "</td>
            <td><button class = 'coll-btn' data-id = '".$displayRow['customer_ID']."'>UPDATE</button></td>
            <td><button class = 'history-btn' data-id = '".$displayRow['customer_ID']."'>HISTORY</button></td>
    <td><img class = 'del-img' src = 'trash.png' data-del = '".$displayRow['customer_ID']."'></td>


        </tr>";
        }
    $td .= "</tbody>";
    echo $td;   
    } 
}

    
?>
