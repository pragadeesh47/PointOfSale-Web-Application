<?php

require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
if(isset($_POST['input'])){
    $input = $_POST['input'];
    $query = "SELECT * FROM customers WHERE  customer_name  LIKE '{$input}%' AND email = '$email' OR customer_ID  LIKE '{$input}%' AND email = '$email' OR customer_mobile  LIKE '{$input}%' AND email = '$email'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $displayRows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if(mysqli_num_rows($result)>0){
        $td = "<thead><tr>
        <th>SERIAL NO</th>
        <th>CUSTOMER ID</th>
        <th>CUSTOMER NAME</th>
        <th>MOBILE</th>
        <th>PARTICULAR</th>
        <th>BALANCE</th>
        <th>UPDATE</th>
        <th>HISTORY</th>
    </tr></thead><tbody>";
$serial_no = 1;
    foreach($displayRows as $displayRow){
    $td .= "<tr style='background-color:gray;' id = '".$displayRow['customer_ID']."' >
        <td>" . $serial_no++ . "</td>
        <td>" . $displayRow['customer_ID'] . "</td>
        <td>" . $displayRow['customer_name']. "</td>
        <td>" . $displayRow['customer_mobile']. "</td>
        <td>" . $displayRow['customer_particulars']. "</td>
        <td  class = 'balance'>" . $displayRow['customer_balance']. "</td>
        <td><button class = 'coll-btn' data-id = '".$displayRow['customer_ID']."'>UPDATE</button></td>
        <td><button class = 'history-btn' data-id = '".$displayRow['customer_ID']."'>HISTORY</button></td>
    </tr>";
    }
        $td .= "</tbody>";
echo $td;   
    }
    else{
        $td = "<thead><tr>
        <th>SERIAL NO</th>
        <th>CUSTOMER ID</th>
        <th>CUSTOMER NAME</th>
        <th>MOBILE</th>
        <th>PARTICULAR</th>
        <th>BALANCE</th>
        <th>UPDATE</th>
        <th>HISTORY</th>
    </tr></thead><tbody><tr><td colspan='8' style='text-align:center;'>No records found</td></tr><tbody>";
        echo $td;
    }
}

?>