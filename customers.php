<?php
require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
if($_POST['name']){
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $place = $_POST['place'];
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
        $customerID=1001;
    }
    else{
        $customerID = 1001;
      for($i=0;$i<$numOfRows;$i++){
        if(in_array($customerID,$newArray)){
            $customerID++;
        }
        else{
            break;
        }
      }
    }

    $mobileCheck = (int) $mobile;
    $query = "SELECT * FROM customerdetails WHERE mobile = '$mobileCheck' AND email = '$email'";
    $result = mysqli_query($con,$query);
    $row = mysqli_num_rows($result);
    if($row==1){
        echo "Mobile number already exists";
    }
    else{
    $query  = "INSERT INTO customerdetails (name,mobile,place,remarks,email,date,customer_id) VALUES('$name','$mobile','$place','$remarks','$email','$date','$customerID')";
    $result = mysqli_query($con, $query);
    $query  = "INSERT INTO customerdetailshistory (name,remarks,email,date,customer_id) VALUES('$name','$remarks','$email','$date','$customerID')";
    $result = mysqli_query($con, $query);
    
    $displayQuery  ="SELECT * FROM customerdetails WHERE email = '$email'";
    $displayResult = mysqli_query($con, $displayQuery);
    $displayRows = mysqli_fetch_all($displayResult,MYSQLI_ASSOC);

    $td="<thead>
    <tr>
    <th>SERIAL NO</th>
    <th>CUSTOMER ID</th>
    <th>NAME</th>
    <th>MOBILE</th>
    <th>PLACE</th>
    <th>REMARKS</th>
    <th>UPDATE</th>
    <th>HISTORY</th>
    <th>DELETE</th>
    </tr></thead><tbody>";

    $serialNo = 1;
    foreach($displayRows as $row){
        $td.="
        <tr id = '".$row['customer_id']."'>
        <td>".$serialNo++."</td>
        <td>".$row['customer_id']."</td>
        <td>".$row['name']."</td>
        <td>".$row['mobile']."</td>
        <td>".$row['place']."</td>
        <td class='rem'>".$row['remarks']."</td> 
        <td><button class = 'coll-btn' data-id = '".$row['customer_id']."'>UPDATE</button></td>
        <td><button class = 'history-btn' data-id = '".$row['customer_id']."'>HISTORY</button></td>   
        <td><img class = 'del-img' src = 'trash.png' data-del = '".$displayRow['customer_id']."'></td>

        </tr>
        ";
    }
    $td.="</tbody>";
    echo $td;
}
}

?>