<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
if($_POST['name']){
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $particular = $_POST['particular'];
    $remarks = $_POST['remarks'];
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
        $orderID=1001;
    }
    else{
        $orderID = 1001;
      for($i=0;$i<$numOfRows;$i++){
        if(in_array($orderID,$newArray)){
            $orderID++;
        }
        else{
            break;
        }
      }
    }
    $query  = "INSERT INTO orders (name,mobile,particular,remarks,email,date,order_id) VALUES('$name','$mobile','$particular','$remarks','$email','$date','$orderID')";
    $result = mysqli_query($con, $query);
    
    $displayQuery  ="SELECT * FROM orders WHERE email = '$email'";
    $displayResult = mysqli_query($con, $displayQuery);
    $displayRows = mysqli_fetch_all($displayResult,MYSQLI_ASSOC);

    $td="<thead>
    <tr>
    <th>SERIAL NO</th>
    <th>ORDER ID</th>
    <th>NAME</th>
    <th>MOBILE</th>
    <th>PARTICULAR</th>
    <th>STATUS</th>
    <th>REMARKS</th>
    <th>UPDATE</th>
    <th>DELETE</th>
    </tr></thead><tbody>";

    $serialNo = 1;
    foreach($displayRows as $row){
        if($row['status'] == "Success" || $row['status']=="Failed" || $row['status']=="pending"){
            $td.="
            <tr id='".$row['order_id']."'>
            <td>".$serialNo++."</td>
            <td>".$row['order_id']."</td>
            <td>".$row['name']."</td>
            <td>".$row['mobile']."</td>
            <td>".$row['particular']."</td>
            <td class = 'sts'>".$row['status']."</td>
            <td class='rem'>".$row['remarks']."</td>  
            <td><button class = 'coll-btn' data-id = '".$row['order_id']."'>UPDATE</button></td>
    <td><img class = 'del-img' src = 'trash.png' data-del = '".$row['order_id']."'></td>
            </tr>
            ";
        }
    }
    $td.="</tbody>";
    echo $td;
}


?>