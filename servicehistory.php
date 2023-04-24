<?php
    require('db.php');
    require('auth_session.php');

    $email = $_SESSION['email'];


    $id = $_POST['id'];


    # CUSTOMER NAME
    $displayQuery = "SELECT * FROM service WHERE email = '$email' AND customer_ID = '$id'";
    $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
    $displayRow = mysqli_fetch_assoc($displayResult, );
    $customer_Name = $displayRow['customer_name'];

    # CUSTOMER HISTORY
    $displayQuery = "SELECT * FROM servicehistory WHERE email = '$email' AND customer_ID = '$id'";
    $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
    $displayRows = mysqli_fetch_all($displayResult, MYSQLI_ASSOC);


    $td = "<thead><tr>
    <th>SERIAL NO</th>
    <th>CUSTOMER NAME</th>
    <th>ADVANCE</th>
    <th>FINAL</th>
    <th>BALANCE</th>
    <th>PAID</th>
    <th>STATUS</th>
    <th>REMARKS</th>
    <th>DATE</th>
</tr><thead><tbody>";
    $serial_no = 1;
    foreach ($displayRows as $displayRow) {
        $td .= "<tr>
        <td>" . $serial_no++ . "</td>
        <td>" . $customer_Name . "</td>
        <td>" . $displayRow['advance'] . "</td>
        <td>" . $displayRow['final'] . "</td>
        <td>" . $displayRow['balance'] . "</td>
        <td>" . $displayRow['paid'] . "</td>
        <td>" . $displayRow['status'] . "</td>
        <td>" . $displayRow['remarks'] . "</td>
        <td>" . $displayRow['date'] . "</td>
    </tr>";
    }
    $td .= "</tbody>";

echo $td;

?>
