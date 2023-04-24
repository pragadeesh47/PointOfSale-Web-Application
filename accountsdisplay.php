<?php
require("adminauth.php");
require("db.php");
$query = "SELECT * FROM admin WHERE status=1";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$td = "<tbody>";
$serial = 1;
$count = 0;
foreach($rows as $row){
    $count++;
    $td.="
    <tr id = '".$row['user_id']."'>
    <td>".$serial++."</td>
    <td>".$row['user_id']."</td>
    <td>".$row['email']."</td>
    <td>".$row['shopname']."</td>
    <td>".$row['mobile']."</td>
    <td>".$row['address']."</td>
    <td>".$row['pincode']."</td>
    <td>".$row['email']."</td>
    </tr>
    ";
    }

$td.="</tbody>";

if($count==0){
    echo "<tbody><tr style='text-align:center;'><td>There are no more requests</td></tr></tbody>";
}
else{
    echo $td;

}

?>