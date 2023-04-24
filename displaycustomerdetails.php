<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$id = $_POST['id'];
$query = "SELECT * FROM customerdetailshistory WHERE email = '$email' AND customer_id = '$id'";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$td="<thead>
<tr>
<td>SERIAL NO</td>
<td>CUSTOMER ID</td>
<td>NAME</td>
<td>REMARKS</td>
<td>DATE</td>
</tr>
</thead><tbody>";

$serialNo=1;
foreach($rows as $row){
    $td.="
    <tr>
    <td>".$serialNo++."</td>
    <td>".$row['customer_id']."</td>
    <td>".$row['name']."</td>
    <td>".$row['remarks']."</td>
    <td>".$row['date']."</td>
    
    </tr>
    ";
}
echo $td;
?>