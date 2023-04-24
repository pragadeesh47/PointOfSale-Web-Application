
<?php
    require('db.php');
    require('auth_session.php');
    $email = $_SESSION['email'];

    // When form submitted, insert values into the database.
    if (isset($_REQUEST['shop'])) {
        // removes backslashes
        $shop = stripslashes($_REQUEST['shop']);
        //escapes special characters in a string
        $shop = mysqli_real_escape_string($con, $shop);
        // $particular    = stripslashes($_REQUEST['particular']);
        // $particular    = mysqli_real_escape_string($con, $particular);
        // $price = stripslashes($_REQUEST['price']);
        // $price = mysqli_real_escape_string($con, $price);
        // $date = stripslashes($_REQUEST['date']);
        // $date = mysqli_real_escape_string($con, $date);
       
        // $status = "unpaid";
        // $date = date("Y-m-d");
        // $create_datetime = date("Y-m-d H:i:s");
        # NEW CUSTOMER INSERTION 
        
  
        $createId  = "SELECT sale_id FROM details
        UNION ALL
        SELECT shop_id FROM purchase 
        UNION ALL
        SELECT customer_id FROM service
        UNION ALL
        SELECT customer_ID FROM customers
        UNION ALL
        SELECT stocks_id FROM stocks
        UNION ALL
        SELECT order_id FROM orders
        UNION ALL
        SELECT id FROM daily
        UNION ALL
        SELECT customer_id FROM customerdetails
        UNION ALL
        SELECT id FROM networks
       
UNION ALL
        SELECT id FROM withdraw
        ";
        $resultId = mysqli_query($con, $createId);
        $idRows = mysqli_fetch_all($resultId, MYSQLI_ASSOC);
        $numOfRows = mysqli_num_rows($resultId);
        
        $newArray=array(); // declare array before foreach loop  
        foreach($idRows as $row) 
        {
        $newArray[]=$row['sale_id']; 
        }

        if($numOfRows==0){
            $shopID=1001;
        }
        else{
            $shopID = 1001;
          for($i=0;$i<$numOfRows;$i++){
            if(in_array($shopID,$newArray)){
                $shopID++;
            }
            else{
                break;
            }
          }
        }

        $query    = "INSERT into `purchase` (shop, email, shop_id)
                     VALUES ('$shop','$email', '$shopID')";
        $result   = mysqli_query($con, $query);

        // $query    = "INSERT into `purchasehistory` (shop_name, unpaid, status, email, shop_id,date,balance)
        // VALUES ('$shop', '$price','$status','$email', '$shopID','$date','$price')";
        // $result   = mysqli_query($con, $query);


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

    } 
    
?>
