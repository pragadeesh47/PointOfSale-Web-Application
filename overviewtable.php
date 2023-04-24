<?php 
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$status = $_POST['status'];
$fromDate = $_POST['fromDate'];
$toDate  =$_POST['toDate'];
if($status=="0"){
    $query  = "SELECT * FROM details WHERE email = '$email' AND saleOrpurchase = 'sale'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $td = "<thead><tr>
    <th>Serial No</th>
    <th>Item</th>
    <th>Quantity</th>
    <th>Price</th>
</tr></thead><tbody>";
$serialNumber=1;

foreach($rows as $row){
    $id = $row['sale_id'];
    $query1  = "SELECT * FROM detailshistory WHERE email = '$email' AND saleOrpurchase = 'sale' AND sale_id = '$id' AND date BETWEEN '$fromDate' AND '$toDate'";
    $result1 = mysqli_query($con, $query1);
    $rows1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    $amount = 0;
    $quantity = 0;
    foreach($rows1 as $row1){
        $amount+= (int) $row1['price'];
        $quantity+= (int) $row1['quantity'];
    }
    if($amount!=0){
    $td .=
    "<tr>
    <td>".$serialNumber++."</td>
    <td>". $row['item']."</td>
    <td>".$quantity."</td>
    <td>".$amount."</td>
    </tr>";
}
}
$td.="</tbody>";
echo $td;
}

else if($status=="1"){
    $query  = "SELECT * FROM details WHERE email = '$email' AND saleOrpurchase = 'expense'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $td = "<thead><tr>
    <th>Serial No</th>
    <th>Item</th>
    <th>Price</th>
</tr></thead><tbody>";
$serialNumber=1;
foreach($rows as $row){
    $id = $row['sale_id'];
    $query1  = "SELECT * FROM detailshistory WHERE email = '$email' AND saleOrpurchase = 'expense' AND sale_id = '$id' AND date BETWEEN '$fromDate' AND '$toDate'";
    $result1 = mysqli_query($con, $query1);
    $rows1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    $amount = 0;
    foreach($rows1 as $row1){
        $amount+= (int) $row1['price'];
    }
    if($amount!=0){
    $td .=
    "<tr>
    <td>".$serialNumber++."</td>
    <td>". $row['item']."</td>
    <td>".$amount."</td>
    </tr>";
}
}
$td.="</tbody>";
echo $td;
}

else if($status=="2"){
    $query  = "SELECT * FROM purchasehistory WHERE email = '$email' AND entryDate BETWEEN '$fromDate' AND '$toDate'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $td = "<thead><tr>
    <th>SERIAL NO</th>
    <th>SHOP ID</th>
    <th>SHOP NAME</th>
    <th>PARTICULAR</th>
    <th>PRICE</th>
</tr><thead><tbody>";
$serialNumber=1;
foreach($rows as $row){
   if($row['status']=="unpaid"){
    $td .= "<tr'>
    <td >" . $serialNumber++ . "</td>
    <td >" . $row['shop_id'] . "</td>
    <td >" . $row['shop_name'] . "</td>
    <td>" . $row['particular'] . "</td>
    <td>".$row['unpaid']."</td>
</tr>";
   }

}
$td.="</tbody>";
echo $td;
}
elseif($status=="3"){
    $displayQuery = "SELECT * FROM service WHERE email = '$email' AND date BETWEEN '$fromDate' AND '$toDate'";
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
    <th>REMARKS</th>
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
<td class = 'remarks'>" . $displayRow['remarks']. "</td>
</tr>";
}
$td .= "</tbody>";
echo $td;
}
?>