<?php
require("auth_session.php");
require("db.php");
$email = $_SESSION['email'];
$date = date("Y-m-d");
if(isset($_POST['fromDate']) && isset($_POST['toDate'])){
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $query = "SELECT * FROM withdrawhistory WHERE email = '$email' AND date between '$fromDate' AND '$toDate'";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
$td = "
<thead>
<tr>
<th>SERIAL NO</th>
<th>UPI</th>
<th>AMOUNT</th>
<th>COMMISSION</th>
<th>WAY</th>
<th>REMARKS</th>
</tr>
</thead><tbody>
";
$serialNo = 1;
foreach($rows as $row){
    if($row['way']==0){
        $way = "Bank";
    }
    else{
        $way = "Hand";
    }
    $td.="
    <tr>
    <td>".$serialNo++."</td>
    <td>".$row['name']."</td>
    <td>".$row['amount']."</td>
    <td>".$row['commission']."</td>
    <td>".$way."</td>
    <td>".$row['remarks']."</td>
    </tr>
     ";
}
$td.="</tbody>";
echo $td;
}
else{

$query = "SELECT * FROM withdrawhistory WHERE email = '$email' AND date = '$date'";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
$td = "
<thead>
<tr>
<th>SERIAL NO</th>
<th>UPI</th>
<th>AMOUNT</th>
<th>COMMISSION</th>
<th>WAY</th>
<th>REMARKS</th>
</tr>
</thead><tbody>
";
$serialNo = 1;
foreach($rows as $row){
    if($row['way']==0){
        $way = "Bank";
    }
    else{
        $way = "Hand";
    }
    $td.="
    <tr>
    <td>".$serialNo++."</td>
    <td>".$row['name']."</td>
    <td>".$row['amount']."</td>
    <td>".$row['commission']."</td>
    <td>".$way."</td>
    <td>".$row['remarks']."</td>
    </tr>
     ";
}
$td.="</tbody>";
echo $td;
}

?>