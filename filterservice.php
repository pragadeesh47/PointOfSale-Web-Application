<?php
    require('db.php');
    require('auth_session.php');
    // When form submitted, check and create user session.

    if(isset($_POST['fromDate']) && (isset($_POST['toDate']))){
        $email = $_SESSION['email'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $query = "SELECT * FROM service WHERE email = '$email' AND date BETWEEN '$fromDate' AND '$toDate' ORDER BY status ASC";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);        
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
    foreach($rows as $displayRow){
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

    elseif($_POST['fromDate'] == "" && $_POST['toDate']==""){
        $email = $_SESSION['email']; 
        $query = "SELECT * FROM `service` WHERE email='$email'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    foreach($rows as $displayRow){
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