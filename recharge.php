<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
$network = $_POST['network'];
$networkType = $_POST['networkType'];
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
    $date = date("Y-m-d");


$query = "INSERT INTO networks (id,network,type, email) VALUES('$id','$network','$networkType','$email')";
$result = mysqli_query($con, $query);
$query = "INSERT INTO daily (id,item,date,email) VALUES('$id','$network','$date','$email')";
$result = mysqli_query($con, $query);


if($networkType=="0"){
    $query = "SELECT * FROM networks WHERE email = '$email' AND type = 0";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    
    foreach($rows as $row){
        $td .= "
        <option value = '".$row['id']."'>".$row['network']."</option>
        ";
    }
    
    echo $td;
      
}
elseif($networkType=="1"){
    $query = "SELECT * FROM networks WHERE email = '$email' AND type = 1";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    
    foreach($rows as $row){
        $td .= "
        <option value = '".$row['id']."'>".$row['network']."</option>
        ";
    }
    
    echo $td;
      
}

elseif($networkType=="2"){
    $query = "SELECT * FROM networks WHERE email = '$email' AND type = 2";
    $result = mysqli_query($con, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    
    foreach($rows as $row){
        $td .= "
        <option value = '".$row['id']."'>".$row['network']."</option>
        ";
    }
    
    echo $td;
      
}
?>