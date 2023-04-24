<?php
    require('db.php');
    require('auth_session.php');

    $email = $_SESSION['email'];
    $displayQuery = "SELECT * FROM service WHERE email = '$email' ORDER BY status ASC";
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

?>
