<?php
require("auth_session.php");
require("db.php");
$email = $_SESSION['email'];
$id = $_POST['id'];

$query = "SELECT * FROM daily WHERE email = '$email' AND id = '$id'";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_assoc($result);
$item = $rows['item'];
$query = "SELECT * FROM dailyhistory WHERE email = '$email' AND id = '$id'";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$td = "
<thead>
<tr>
<th>SERIAL NO</th>
<th>ITEM ID</th>
<th>ITEM</th>
<th>OPENING</th>
<th>PURCHASE</th>
<th>CLOSING</th>
<th>SALES</th>
<th>DATE</th>

</tr>
</thead><tbody>
";
$serial = 1;

foreach($rows as $row){
    $td.="
    <tr id = '".$row['id']."'>
    <td>".$serial++."</td>
    <td>".$row['id']."</td>
    <td>".$item."</td>
    <td>".$row['opening']."</td>
    <td>".$row['purchase']."</td>
    <td>".$row['closing']."</td>
    <td>".$row['profit']."</td>
    <td>".$row['date']."</td>
    </tr>
    ";
}

$td.="</tbody>";
echo $td;
?>