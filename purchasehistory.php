<?php
    require('db.php');
    require('auth_session.php');

    $email = $_SESSION['email'];


    $id = $_POST['id'];


    # CUSTOMER NAME
 

    # CUSTOMER HISTORY
    $displayQuery = "SELECT * FROM purchasehistory WHERE email = '$email' AND shop_id = '$id'";
    $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
    $displayRows = mysqli_fetch_all($displayResult, MYSQLI_ASSOC);
    // $displayQuery = "SELECT * FROM purchase WHERE email = '$email' AND shop_id = '$id'";
    // $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
    // $displayRows = mysqli_fetch_all($displayResult, MYSQLI_ASSOC);


    $td = "<thead><tr>
    <th>SERIAL NO</th>
    <th>SHOP</th>
    <th>PARTICULAR</th>
    <th>DATE</th>
    <th>UNPAID</th>
    <th>PAID</th>
    <th>BALANCE</th>
    <th>STATUS</th>
    <th>ENTRY DATE</th>
</tr><thead><tbody>";
    $serial_no = 1;
    foreach ($displayRows as $displayRow) {
        $td .= "<tr>
        <td>" . $serial_no++ . "</td>
        <td>" . $displayRow['shop_name']. "</td>
        <td>" . $displayRow['particular']. "</td>
        <td>" . $displayRow['date'] . "</td>
        <td>" . $displayRow['unpaid'] . "</td>
        <td>" . $displayRow['paid'] . "</td>
        <td>" . $displayRow['balance'] . "</td>
        <td>" . $displayRow['status'] . "</td>
        <td>" . $displayRow['entryDate'] . "</td>
    </tr>";
    }
    $td .= "</tbody>";

echo $td;

?>
