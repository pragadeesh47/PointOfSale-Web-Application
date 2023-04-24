<?php 
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$query = "SELECT * FROM stocks WHERE email = '$email' ORDER BY quantity";
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
    <th>UPDATE</th>
    <th>HISTORY</th>    
    </tr>
    </thead>
    <tbody>
    ";

    $serial = 1;
    $className = '';
    foreach($rows as $row){
        if($row['quantity']<5){
            $className = "low";
        }
        else{
            $className="";
        }
        $td.="
        <tr id = '".$row['stocks_id']."'>
        <td>".$serial++."</td>
        <td>".$row['stocks_id']."</td>
        
        <td><span class = 'name' data-edit = '".$row['stocks']."'>".$row['stocks']."</span>  <span class = 'edit-container'>
        <img data-name = '".$row['stocks_id']."' data-edit = '".$row['stocks']."' class = 'edit-btn' src='https://img.icons8.com/external-tanah-basah-basic-outline-tanah-basah/24/null/external-edit-social-media-ui-tanah-basah-basic-outline-tanah-basah.png'/>
        <span></td>
        <td class = 'qty ".$className."'>".$row['quantity']."</td>
        <td class = 'prc'>".$row['price']."</td>
        <td><button class = 'update-btn' data-id = '".$row['stocks_id']."'>UPDATE</button></td>
        <td><button class = 'history-btn' data-id = '".$row['stocks_id']."'>HISTORY</button></td>
        </tr>
        ";
    }
    $td.="</tbody>";
    echo $td;

?>