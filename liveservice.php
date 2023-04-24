<?php

require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
if(isset($_POST['input'])){
    $input = $_POST['input'];
    $query = "SELECT * FROM service WHERE customer_name  LIKE '{$input}%'  AND email = '$email' OR customer_id  LIKE '{$input}%' AND email = '$email' OR mobile  LIKE '{$input}%'  AND email = '$email'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $displayRows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if(mysqli_num_rows($result)>0){
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
    $td .= "<tr style='background-color:gray;' id = '".$displayRow['customer_id']."'>
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
    else{
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
</thead><tbody>
<tr><td colspan='13' style='text-align:center;'>No records found</td></tr></tbody>
";
        echo $td;
    }
}

?>