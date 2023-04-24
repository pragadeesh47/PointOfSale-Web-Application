<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];

$query = "SELECT * FROM orders WHERE email = '$email'";
$result  = mysqli_query($con, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$td="<thead>
<tr>
<td>SERIAL NO</td>
<td>ORDER ID</td>
<td>NAME</td>
<td>MOBILE</td>
<td>PARTICULAR</td>
<td>STATUS</td>
<td>REMARKS</td>
<td>DATE</td>
</tr></thead><tbody>";

$serialNo = 1;
foreach($rows as $row){
        $td.="
        <tr id='".$row['order_id']."'>
        <td>".$serialNo++."</td>
        <td>".$row['order_id']."</td>
        <td>".$row['name']."</td>
        <td>".$row['mobile']."</td>
        <td>".$row['particular']."</td>
        <td class = 'sts'>".$row['status']."</td>
        <td class='rem'>".$row['remarks']."</td>  
        <td>".$row['date']."</td>  
        </tr>
        ";
    }
$td.="</tbody>";
echo $td;
?>