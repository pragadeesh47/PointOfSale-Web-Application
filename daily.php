<?php
require("auth_session.php");
require("db.php");
$email = $_SESSION['email'];

if(isset($_POST['item'])){
    $item = $_POST['item'];
    $date = date("Y-m-d");
    $createId  = "SELECT sale_id FROM details
        UNION ALL
        SELECT shop_id FROM purchase 
        UNION ALL
        SELECT customer_id FROM service
        UNION ALL
        SELECT customer_ID FROM customers
        UNION ALL
        SELECT stocks_id FROM stocks
        UNION ALL
        SELECT order_id FROM orders
        UNION ALL
        SELECT id FROM daily
        UNION ALL
        SELECT customer_id FROM customerdetails
        UNION ALL
SELECT id FROM networks

UNION ALL
        SELECT id FROM withdraw
        ";
    $resultId = mysqli_query($con, $createId);
    $idRows = mysqli_fetch_all($resultId, MYSQLI_ASSOC);
    $numOfRows = mysqli_num_rows($resultId);
    
    $newArray=array(); // declare array before foreach loop  
    foreach($idRows as $row) 
    {
    $newArray[]=$row['sale_id']; 
    }

    if($numOfRows==0){
        $id=1001;
    }
    else{
        $id = 1001;
      for($i=0;$i<$numOfRows;$i++){
        if(in_array($id,$newArray)){
            $id++;
        }
        else{
            break;
        }
      }
    }
    $query = "INSERT INTO daily (id,item,date,email) VALUES('$id','$item','$date','$email')";
    $result = mysqli_query($con, $query);
  
$query = "SELECT * FROM daily WHERE email = '$email'";
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
}
?>