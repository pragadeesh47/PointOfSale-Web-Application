<?php
require("auth_session.php");
require("db.php");
$email = $_SESSION['email'];
$query = "SELECT * FROM daily WHERE email = '$email' ORDER BY opening DESC";
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
<th>UPDATE</th>
<th>HISTORY</th>
</tr>
</thead><tbody>
";
$serial = 1;

foreach($rows as $row){
    $td.="
    <tr id = '".$row['id']."'>
    <td>".$serial++."</td>
    <td>".$row['id']."</td>
    <td>".$row['item']."</td>
    <td class = 'opn'>".$row['opening']."</td>
    <td class = 'prs'>".$row['purchase']."</td>
    <td class = 'cls'>".$row['closing']."</td>
    <td class = 'prft'>".$row['profit']."</td>
    <td><button class = 'coll-btn' data-id = '".$row['id']."'>UPDATE</button></td>
    <td><button class = 'history-btn' data-id = '".$row['id']."'>HISTORY</button></td>
    </tr>
    ";
}

$td.="</tbody>";
echo $td;
?>