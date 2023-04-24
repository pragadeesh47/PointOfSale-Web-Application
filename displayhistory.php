<?php
    require('db.php');
    require('auth_session.php');

    $email = $_SESSION['email'];


    $id = $_POST['id'];


    # CUSTOMER NAME
    $displayQuery = "SELECT * FROM customers WHERE email = '$email' AND customer_ID = '$id'";
    $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
    $displayRow = mysqli_fetch_assoc($displayResult, );
    $customer_Name = $displayRow['customer_name'];

    # CUSTOMER HISTORY
    $displayQuery = "SELECT * FROM customerhistory WHERE email = '$email' AND customer_ID = '$id'";
    $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
    $displayRows = mysqli_fetch_all($displayResult, MYSQLI_ASSOC);


    $td = "<thead><tr>
    <th>SERIAL NO</th>
    <th>CUSTOMER NAME</th>
    <th>CREDIT</th>
    <th>PAYMENT</th>
    <th>BALANCE</th>
    <th>REMARKS</th>
    <th>DATE</th>
</tr><thead><tbody>";
    $serial_no = 1;
    foreach ($displayRows as $displayRow) {
        $td .= "<tr>
        <td>" . $serial_no++ . "</td>
        <td>" . $customer_Name . "</td>
        <td>" . $displayRow['credit'] . "</td>
        <td>" . $displayRow['payment'] . "</td>
        <td>" . $displayRow['balance'] . "</td>
        <td>" . $displayRow['remarks'] . "</td>
        <td>" . $displayRow['date'] . "</td>
    </tr>";
    }
    $td .= "</tbody>";

echo $td;

?>
