<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
if($_POST['stock']!=""){
    $stock = $_POST['stock'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
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
        $stock_id=1001;
    }
    else{
        $stock_id = 1001;
      for($i=0;$i<$numOfRows;$i++){
        if(in_array($stock_id,$newArray)){
            $stock_id++;
        }
        else{
            break;
        }
      }
    }
    $query = "INSERT INTO stocks (stocks_id,stocks,quantity,price,date,email) VALUES('$stock_id','$stock','$quantity','$price','$date','$email')";
    $result = mysqli_query($con, $query);

    $query = "INSERT INTO stockshistory (stock_id,quantity,price,date,email) VALUES('$stock_id','$quantity','$price','$date','$email')";
    $result = mysqli_query($con, $query);

    $query = "INSERT INTO details (item,rate,saleOrpurchase,quantity,date,email,sale_id) VALUES('$stock','$price','sale','$quantity','$date','$email','$stock_id')";
    $result = mysqli_query($con, $query);

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
}
?>