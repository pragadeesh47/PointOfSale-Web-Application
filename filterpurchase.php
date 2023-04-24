<?php
    require('db.php');
    require('auth_session.php');
    // When form submitted, check and create user session.

    if(isset($_POST['fromDate']) && (isset($_POST['toDate']))){
        $email = $_SESSION['email'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $query = "SELECT * FROM purchase WHERE email = '$email' AND entryDate BETWEEN '$fromDate' AND '$toDate'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);        
       
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
    foreach ($rows as $displayRow) {
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
           
    }

    elseif($_POST['fromDate'] == "" && $_POST['toDate']==""){
        $email = $_SESSION['email']; 
        $query = "SELECT * FROM `purchase` WHERE email='$email'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    foreach ($rows as $displayRow) {
        $td .= "<tr data-id='" . $displayRow['shop_id'] . "' id = '".$displayRow['shop_id']."'>
            <td >" . $serial_no++ . "</td>
            <td >" . $displayRow['shop_id'] . "</td>
            <td >" . $displayRow['shop'] . "</td>
            <td>" . $displayRow['particulars'] . "</td>
            <td>" . $displayRow['date'] . "</td>
            <td class = 'amount'>" . $displayRow['price'] . "</td>
            <td class = 'status'>" . $displayRow['status'] . "</td>
            <td><button class='status-btn' data-id='" . $displayRow['shop_id'] . "'>UPDATE</button></td>
            <td><button class='history-btn' data-id='" . $displayRow['shop_id'] . "'>HISTORY</button></td>
        <td><img class = 'del-img' src = 'trash.png' data-del = '".$displayRow['shop_id']."'></td>

    
        </tr>";
    }
    
    $td.="</tbody>";
    echo $td;
    }

 
       
?>