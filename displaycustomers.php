<?php
    require('db.php');
    require('auth_session.php');

    $email = $_SESSION['email'];
    $displayQuery = "SELECT * FROM customers WHERE email = '$email'";
    $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
    $displayRows = mysqli_fetch_all($displayResult, MYSQLI_ASSOC);

    $td = "<thead><tr>
    <th>SERIAL NO</th>
    <th>CUSTOMER ID</th>
    <th>CUSTOMER NAME</th>
    <th>MOBILE</th>
    <th>PARTICULAR</th>
    <th>BALANCE</th>
    <th>UPDATE</th>
    <th>HISTORY</th>
    <th>DELETE</th>
</tr></thead><tbody>";
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

?>
