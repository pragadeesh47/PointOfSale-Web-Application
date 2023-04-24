<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$query = "SELECT * FROM customerdetails WHERE email = '$email'";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
$td="<thead>
<tr>
<th>SERIAL NO</th>
<th>CUSTOMER ID</th>
<th>NAME</th>
<th>MOBILE</th>
<th>PLACE</th>
<th>REMARKS</th>
<th>UPDATE</th>
<th>HISTORY</th>
<th>DELETE</th>
</tr></thead><tbody>";

$serialNo = 1;
foreach($rows as $row){
    $td.="
    <tr id='".$row['customer_id']."'>
    <td>".$serialNo++."</td>
    <td>".$row['customer_id']."</td>
    <td>".$row['name']."</td>
    <td>".$row['mobile']."</td>
    <td>".$row['place']."</td>
    <td class='rem'>".$row['remarks']."</td>  
    <td><button class = 'coll-btn' data-id = '".$row['customer_id']."'>UPDATE</button></td>
    <td><button class = 'history-btn' data-id = '".$row['customer_id']."'>HISTORY</button></td> 
    <td><img class = 'del-img' src = 'trash.png' data-del = '".$row['customer_id']."'></td>

    </tr>
    ";
}
$td.="</tbody>";
echo $td;
?>