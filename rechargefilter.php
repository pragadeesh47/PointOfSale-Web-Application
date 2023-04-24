<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$id = $_POST['id'];
$fromDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];

if($id=="0"){
    $query = "SELECT * FROM rechargehistory WHERE status = '$id' AND email = '$email' AND date BETWEEN '$fromDate' AND '$toDate'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $tab = "
    <thead>
    <tr>
    <th>SERIAL NO</th>
    <th>NETWORK</th>
    <th>NUMBER</th>
    <th>AMOUNT</th>
    <th>BALANCE</th>
    </tr>
    </thead><tbody>";
$serial = 1;
    foreach($rows as $row){
        $tab.="
        <tr>
        <td>".$serial++."</td>
        <td>".$row['network']."</td>
        <td>".$row['number']."</td>
        <td>".$row['amount']."</td>
        <td>".$row['newbalance']."</td>
        </tr>
        ";
    }
    $tab.="</tbody>";
    echo $tab;
}
else if($id=="1"){
    $query = "SELECT * FROM rechargehistory WHERE status = '$id' AND email = '$email' AND date BETWEEN '$fromDate' AND '$toDate'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $tab = "
    <thead>
    <tr>
    <th>SERIAL NO</th>
    <th>NETWORK</th>
    <th>NUMBER</th>
    <th>AMOUNT</th>
    <th>BALANCE</th>
    </tr>
    </thead><tbody>";
$serial = 1;
    foreach($rows as $row){
        $tab.="
        <tr>
        <td>".$serial++."</td>
        <td>".$row['network']."</td>
        <td>".$row['number']."</td>
        <td>".$row['amount']."</td>
        <td>".$row['newbalance']."</td>
        </tr>
        ";
    }
    $tab.="</tbody>";
    echo $tab;
}
else if($id=="2"){
    $query = "SELECT * FROM rechargehistory WHERE status = '$id' AND email = '$email' AND date BETWEEN '$fromDate' AND '$toDate'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $tab = "
    <thead>
    <tr>
    <th>SERIAL NO</th>
    <th>NETWORK</th>
    <th>NUMBER</th>
    <th>AMOUNT</th>
    <th>BALANCE</th>
    </tr>
    </thead><tbody>";
$serial = 1;
    foreach($rows as $row){
        $tab.="
        <tr>
        <td>".$serial++."</td>
        <td>".$row['network']."</td>
        <td>".$row['number']."</td>
        <td>".$row['amount']."</td>
        <td>".$row['newbalance']."</td>
        </tr>
        ";
    }
    $tab.="</tbody>";
    echo $tab;
}
?>