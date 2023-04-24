<?php 
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$id = $_POST['id'];
$query = "SELECT * FROM stocks WHERE email = '$email' AND stocks_id = '$id'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_assoc($result);
$stock = $rows['stocks'];

$query = "SELECT * FROM stockshistory WHERE email = '$email' AND stock_id = '$id'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

    $td = "
    <thead>
    <tr>
    <th>SERIAL NO</th>
    <th>STOCK ID</th>
    <th>STOCK</th>
    <th>QUANTITY</th>
    <th>PRICE</th>
    <th>DATE</th>
    </tr>
    </thead>
    <tbody>
    ";

    $serial = 1;
    foreach($rows as $row){
        $td.="
        <tr id = '".$row['stock_id']."'>
        <td>".$serial++."</td>
        <td>".$row['stock_id']."</td>
        <td>".$stock."</td>
        <td>".$row['quantity']."</td>
        <td>".$row['price']."</td>
        <td>".$row['date']."</td>
        
        </tr>
        ";
    }
    $td.="</tbody>";
    echo $td;

?>