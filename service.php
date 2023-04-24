
<?php
    require('db.php');
    require('auth_session.php');
    $email = $_SESSION['email'];

    // When form submitted, insert values into the database.
    if (isset($_REQUEST['name'])) {
        // removes backslashes
        $name = stripslashes($_REQUEST['name']);
        //escapes special characters in a string
        $name = mysqli_real_escape_string($con, $name);
        $place    = stripslashes($_REQUEST['place']);
        $place    = mysqli_real_escape_string($con, $place);
        $mobile    = stripslashes($_REQUEST['mobile']);
        $mobile    = mysqli_real_escape_string($con, $mobile);
        $complaint = stripslashes($_REQUEST['complaint']);
        $complaint = mysqli_real_escape_string($con, $complaint);
        $amount = stripslashes($_REQUEST['amount']);
        $amount = mysqli_real_escape_string($con, $amount);
      
        $date = date("Y-m-d");
        // $create_datetime = date("Y-m-d H:i:s");
        # NEW CUSTOMER INSERTION 

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
            $customer_ID=1001;
        }
        else{
            $customer_ID = 1001;
          for($i=0;$i<$numOfRows;$i++){
            if(in_array($customer_ID,$newArray)){
                $customer_ID++;
            }
            else{
                break;
            }
          }
        }

        $query    = "INSERT into `service` (customer_name, place, complaint, advance_amount, email,date,customer_id,mobile)
                     VALUES ('$name', '$place', '$complaint','$amount', '$email','$date','$customer_ID','$mobile')";
        $result   = mysqli_query($con, $query);

        $query    = "INSERT into `servicehistory` (customer_name, advance, email,date,customer_id,paid)
                     VALUES ('$name','$amount', '$email','$date','$customer_ID','$amount')";
        $result   = mysqli_query($con, $query);


        $displayQuery = "SELECT * FROM service WHERE email = '$email'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_all($displayResult, MYSQLI_ASSOC);

    
        $td = "<thead><tr>
        <th>SERIAL NO</th>
        <th>CUSTOMER ID</th>
        <th>CUSTOMER NAME</th>
        <th>MOBILE</th>
        <th>PLACE</th>
        <th>COMPLAINT</th>
        <th>ADVANCE</th>
        <th>FINAL</th>
        <th>BALANCE</th>
        <th>STATUS</th>
        <th>UPDATE</th>
        <th>REMARKS</th>
        <th>HISTORY</th>
        <th>DELETE</th>
    </tr></thead><tbody>";
$serial_no = 1;
    foreach($displayRows as $displayRow){
    $td .= "<tr id = '".$displayRow['customer_id']."'>
    <td >" . $serial_no++ . "</td>
    <td >" . $displayRow['customer_id'] . "</td>
    <td >" . $displayRow['customer_name']. "</td>
    <td >" . $displayRow['mobile']. "</td>
    <td >" . $displayRow['place']. "</td>
    <td >" . $displayRow['complaint']. "</td>
    <td class = 'advance' >" .$displayRow['advance_amount']. "</td>
    <td class = 'final' >" .$displayRow['final_amount']. "</td>
    <td class = 'balance' >" .$displayRow['balance_amount']. "</td>
    <td class = 'status' >" .$displayRow['status']. "</td>
    <td ><button class = 'status-btn' data-id = '".$displayRow['customer_id']."'>UPDATE</button></td>
    <td class = 'remarks'>" . $displayRow['remarks']. "</td>
    <td ><button class = 'history-btn' data-id = '".$displayRow['customer_id']."'>HISTORY</button></td>
    <td><img class = 'del-img' src = 'trash.png' data-del = '".$displayRow['customer_id']."'></td>

    </tr>";
    }
$td .= "</tbody>";
echo $td;
    } 
    
?>
