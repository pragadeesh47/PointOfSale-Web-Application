<?php

require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
if(isset($_POST['input'])){
    $input = $_POST['input'];
    $query = "SELECT * FROM purchase WHERE shop  LIKE '{$input}%'  AND email = '$email' OR shop_id  LIKE '{$input}%' AND email = '$email' ";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $displayRows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if(mysqli_num_rows($result)>0){
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
    $td .= "<tr style='background-color:gray;' data-id='" . $displayRow['shop_id'] . "' id = '".$displayRow['shop_id']."'>
        <td data-id='" . $displayRow['shop_id'] ."'data-name='". $displayRow['shop'] . "'>" . $serial_no++ . "</td>
        <td data-id='" . $displayRow['shop_id'] . "'data-name='". $displayRow['shop'] . "'>" . $displayRow['shop_id'] . "</td>
        <td data-id='" . $displayRow['shop_id'] . "'data-name='". $displayRow['shop'] . "'>" . $displayRow['shop'] . "</td>
        <td class = 'pt' data-id='" . $displayRow['shop_id'] . "'data-name='". $displayRow['shop'] . "'>" . $displayRow['particulars'] . "</td>
        <td class = 'dt'>" . $displayRow['date'] . "</td>
        <td data-id='" . $displayRow['shop_id'] . "data-name='". $displayRow['shop'] . "'' class = 'amount'>" . $displayRow['price'] . "</td>
        <td data-id='" . $displayRow['shop_id'] . "data-name='". $displayRow['shop'] . "'' class = 'status'>" . $displayRow['status'] . "</td>
        <td data-id='" . $displayRow['shop_id'] . "'><button class='status-btn' data-id='" . $displayRow['shop_id'] . "'>UPDATE</button></td>
        <td data-id='" . $displayRow['shop_id'] . "'><button class='history-btn' data-id='" . $displayRow['shop_id'] . "'>HISTORY</button></td>
        <td><img class = 'del-img' src = 'trash.png' data-del = '".$displayRow['shop_id']."'></td>


    </tr>";
}

$td.="</tbody>";
echo $td;

    }
    else{
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
    </tr></thead><tbody><tr><td colspan='10' style='text-align:center;'>No records found</td></tr><tbody>";
        echo $td;
    }
}

?>