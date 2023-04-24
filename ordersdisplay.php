<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$query = "SELECT * FROM orders WHERE email = '$email'";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
$td="<thead>
<tr>
<th>SERIAL NO</th>
<th>CUSTOMER ID</th>
<th>NAME</th>
<th>MOBILE</th>
<th>PARTICULAR</th>
<th>STATUS</th>
<th>REMARKS</th>
<th>UPDATE</th>
<th>DELETE</th>
</tr></thead><tbody>";

$serialNo = 1;
foreach($rows as $row){
    if($row['status'] == "Success" || $row['status']=="Failed" || $row['status']=="pending"){
        $td.="
        <tr id='".$row['order_id']."'>
        <td>".$serialNo++."</td>
        <td>".$row['order_id']."</td>
        <td>".$row['name']."</td>
        <td>".$row['mobile']."</td>
        <td>".$row['particular']."</td>
        <td class = 'sts'>".$row['status']."</td>
        <td class='rem'>".$row['remarks']."</td>  
        <td><button class = 'coll-btn' data-id = '".$row['order_id']."'>UPDATE</button></td>
    <td><img class = 'del-img' src = 'trash.png' data-del = '".$row['order_id']."'></td>

        </tr>
        ";
    }
   
}
$td.="</tbody>";
echo $td;
?>