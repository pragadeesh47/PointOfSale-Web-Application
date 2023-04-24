<?php
    require('db.php');
    require('auth_session.php');

    $email = $_SESSION['email'];
    $displayQuery = "SELECT * FROM purchase WHERE email = '$email'";
    $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
    $displayRows = mysqli_fetch_all($displayResult, MYSQLI_ASSOC);

    $td = "<thead><tr>
    <th>SERIAL NO</th>
    <th>SHOP ID</th>
    <th>SHOP NAME</th>
    <th>PARTICULAR</th>
    <th>DATE</th>
    <th>PRICE</th>
    <th>STATUS</th>
    <th>UPDATE</th>
    <th>HISTORY</th>
    <th>DELETE</th>
</tr><thead><tbody>";
$serial_no = 1;
foreach ($displayRows as $displayRow) {
    $td .= "<tr data-id='" . $displayRow['shop_id'] . "' id = '".$displayRow['shop_id']."'>
        <td >" . $serial_no++ . "</td>
        <td >" . $displayRow['shop_id'] . "</td>
        <td >" . $displayRow['shop'] . "</td>
        <td class = 'pt'>" . $displayRow['particulars'] . "</td>
        <td class = 'dt'>" . $displayRow['date'] . "</td>
        <td class = 'amount'>" . $displayRow['price'] . "</td>
        <td class = 'status'>" . $displayRow['status'] . "</td>
        <td><button class='status-btn' data-id='" . $displayRow['shop_id'] . "'>UPDATE</button></td>
        <td><button class='history-btn' data-id='" . $displayRow['shop_id'] . "'>HISTORY</button></td>
        <td><img class = 'del-img' src = 'trash.png' data-del = '".$displayRow['shop_id']."'></td>

    </tr>";
}

$td.="</tbody>";
echo $td;


?>
