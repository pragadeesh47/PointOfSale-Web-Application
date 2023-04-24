<?php
    require('db.php');
    require('auth_session.php');
    // When form submitted, check and create user session.
    $email = $_SESSION['email'];
    $id = $_POST['id'];
    $statusType = $_POST['statusType'];
    if($statusType=="0" && $_POST['finalAmount']!=""){
    $remarks = $_POST['remarks'];
    $remark = $_POST['remarks'];
    $status = "Success";
    $finalAmount = $_POST['finalAmount'];
    $balanceAmount = $_POST['balanceAmount'];

    if($remarks!=""){
        $query = "UPDATE service SET status = '$status', final_amount = '$finalAmount', balance_amount = $balanceAmount, remarks = '$remarks' WHERE email = '$email' AND customer_id = '$id'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        
    }
    else{
        $query = "UPDATE service SET status = '$status', final_amount = '$finalAmount', balance_amount = $balanceAmount WHERE email = '$email' AND customer_id = '$id'";
        $result = mysqli_query($con, $query) or die(mysql_error());
    }
   
    // $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);    
    
    $displayQuery = "SELECT * FROM service WHERE email = '$email' AND customer_id = '$id'";
    $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
    $displayRows = mysqli_fetch_assoc($displayResult);
    $status = $displayRows['status'];
    $final = $displayRows['final_amount'];
    $balance = $displayRows['balance_amount'];
    $remarks = $displayRows['remarks'];
    $advance = $displayRows['advance_amount'];
    $name = $displayRows['customer_name'];

if($remark!=""){
    $query    = "INSERT into `servicehistory` (customer_name, advance,final, balance, email, customer_id,status,remarks)
    VALUES ('$name','$advance','$final','$balance', '$email','$id','$status','$remark')";
    $result   = mysqli_query($con, $query);
}
else{
    $query    = "INSERT into `servicehistory` (customer_name, advance,final, balance, email, customer_id,status)
    VALUES ('$name','$advance','$final','$balance', '$email','$id','$status')";
    $result   = mysqli_query($con, $query);
}
    


    // $balance = $displayRows['balance_amount'];
    $res ="$final".".$balance".".$status".".$advance".".$remarks";
    echo $res;
    
       
//         $td = "<thead><tr>
//         <th>SERIAL NO</th>
//         <th>CUSTOMER ID</th>
//         <th>CUSTOMER NAME</th>
//         <th>MOBILE</th>
//         <th>PLACE</th>
//         <th>COMPLAINT</th>
//         <th>ADVANCE</th>
//         <th>FINAL</th>
//         <th>BALANCE</th>
//         <th>STATUS</th>
//         <th>UPDATE</th>
//     </tr></thead><tbody>";
// $serial_no = 1;
//     foreach($displayRows as $displayRow){
//     $td .= "<tr>
//     <td >" . $serial_no++ . "</td>
//     <td >" . $displayRow['customer_id'] . "</td>
//     <td >" . $displayRow['customer_name']. "</td>
//     <td >" . $displayRow['mobile']. "</td>
//     <td >" . $displayRow['place']. "</td>
//     <td >" . $displayRow['complaint']. "</td>
//     <td >" .$displayRow['advance_amount']. "</td>
//     <td >" .$displayRow['final_amount']. "</td>
//     <td >" .$displayRow['balance_amount']. "</td>
//     <td >" .$displayRow['status']. "</td>
//     <td ><button class = 'status-btn' data-id = '".$displayRow['customer_id']."'>STATUS</button></td>
//     </tr>";
//     }
//     $td .= "</tbody>";
// echo $td;
           
    }
    else if($statusType=="4"){
        $remarks  = $_POST['remarks'];
        $remark  = $_POST['remarks'];
        $query = "UPDATE service SET  remarks = '$remarks' WHERE email = '$email' AND customer_id = '$id'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $displayQuery = "SELECT * FROM service WHERE email = '$email' AND customer_id = '$id'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_assoc($displayResult);
        $status = $displayRows['status'];
        $final = $displayRows['final_amount'];
        $balance = $displayRows['balance_amount'];
        $advance = $displayRows['advance_amount'];
        $remarks = $displayRows['remarks'];
    $name = $displayRows['customer_name'];
        $query    = "INSERT into `servicehistory` (customer_name, advance,final, balance, email, customer_id,status,remarks)
        VALUES ('$name','$advance','$final','$balance', '$email','$id','$status','$remark')";
        $result   = mysqli_query($con, $query);
        // $balance = $displayRows['balance_amount'];
     $res ="$final".".$balance".".$status".".$advance".".$remarks";
        echo $res;
    }
    else if($statusType=="1"){
        $status = "Success Delivery";

        $displayQuery = "SELECT * FROM service WHERE email = '$email' AND customer_id = '$id'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_assoc($displayResult);
        $balance = $displayRows['balance_amount'];
        $name = $displayRows['customer_name'];
        $paid = $_POST['balanceAmount'];
        $balanceAmount = $balance - (int)$_POST['balanceAmount'];
        if($balanceAmount<0){
            $balanceAmount = 0;
        }
        $remarks = $_POST['remarks'];
        $remark = $_POST['remarks'];
        if($remarks!=""){
            $query = "UPDATE service SET status = '$status', balance_amount = $balanceAmount, remarks = '$remarks' WHERE email = '$email' AND customer_id = '$id'";
            $result = mysqli_query($con, $query) or die(mysql_error());

        }
        else{
            $query = "UPDATE service SET status = '$status', balance_amount = $balanceAmount WHERE email = '$email' AND customer_id = '$id'";
            $result = mysqli_query($con, $query) or die(mysql_error());
        }


    

        // $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);    
        
        $displayQuery = "SELECT * FROM service WHERE email = '$email' AND customer_id = '$id'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_assoc($displayResult);
        $status = $displayRows['status'];
        $final = $displayRows['final_amount'];
        $balance = $displayRows['balance_amount'];
        $advance = $displayRows['advance_amount'];
        $remarks = $displayRows['remarks'];

        if($remark!=""){
            $query    = "INSERT into `servicehistory` (customer_name, advance,final, balance, email, customer_id,status,paid,remarks)
            VALUES ('$name','$advance','$final','$balanceAmount', '$email','$id','$status','$paid','$remark')";
            $result   = mysqli_query($con, $query);
        
        }
        else{
            $query    = "INSERT into `servicehistory` (customer_name, advance,final, balance, email, customer_id,status,paid)
            VALUES ('$name','$advance','$final','$balanceAmount', '$email','$id','$status','$paid')";
            $result   = mysqli_query($con, $query);
        
        }
      

        // $balance = $displayRows['balance_amount'];
     $res ="$final".".$balance".".$status".".$advance".".$remarks";
        echo $res;
       
       
//         $td = "<thead><tr>
//         <th>SERIAL NO</th>
//         <th>CUSTOMER ID</th>
//         <th>CUSTOMER NAME</th>
//         <th>MOBILE</th>
//         <th>PLACE</th>
//         <th>COMPLAINT</th>
//         <th>ADVANCE</th>
//         <th>FINAL</th>
//         <th>BALANCE</th>
//         <th>STATUS</th>
//         <th>UPDATE</th>
//     </tr></thead><tbody>";
// $serial_no = 1;
//     foreach($displayRows as $displayRow){
//     $td .= "<tr>
//     <td >" . $serial_no++ . "</td>
//     <td >" . $displayRow['customer_id'] . "</td>
//     <td >" . $displayRow['customer_name']. "</td>
//     <td >" . $displayRow['mobile']. "</td>
//     <td >" . $displayRow['place']. "</td>
//     <td >" . $displayRow['complaint']. "</td>
//     <td >" .$displayRow['advance_amount']. "</td>
//     <td >" .$displayRow['final_amount']. "</td>
//     <td >" .$displayRow['balance_amount']. "</td>
//     <td >" .$displayRow['status']. "</td>
//     <td ><button class = 'status-btn' data-id = '".$displayRow['customer_id']."'>STATUS</button></td>
//     </tr>";
//     }
//     $td .= "</tbody>";
// echo $td;
    }
    elseif($statusType=="3"){
        $status = "Return";
    $remarks = $_POST['remarks'];
    $remark = $_POST['remarks'];
    if($remarks!=""){
        $query = "UPDATE service SET status = '$status',balance_amount = 0,final_amount = 0,remarks = '$remarks' WHERE email = '$email' AND customer_id = '$id'";
        $result = mysqli_query($con, $query) or die(mysql_error());
    }
    else{
        $query = "UPDATE service SET status = '$status',balance_amount = 0,final_amount = 0 WHERE email = '$email' AND customer_id = '$id'";
        $result = mysqli_query($con, $query) or die(mysql_error());
    }

        
        $displayQuery = "SELECT * FROM service WHERE email = '$email' AND customer_id = '$id'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_assoc($displayResult);
        $status = $displayRows['status'];
        $final = $displayRows['final_amount'];
        $advance = $displayRows['advance_amount'];
        $balance = $displayRows['balance_amount'];
        $remarks = $displayRows['remarks'];
        $name = $displayRows['customer_name'];

        if($remark!=""){
            $query    = "INSERT into `servicehistory` (customer_name, advance,final, balance, email, customer_id,status,remarks)
            VALUES ('$name','$advance','$final','$balance', '$email','$id','$status','$remark')";
            $result   = mysqli_query($con, $query);
        
        }
        else{
            $query    = "INSERT into `servicehistory` (customer_name, advance,final, balance, email, customer_id,status)
            VALUES ('$name','$advance','$final','$balance', '$email','$id','$status')";
            $result   = mysqli_query($con, $query);
        
        }
        
       
        // $balance = $displayRows['balance_amount'];
    
        $res ="$final".".$balance".".$status".".$advance".".$remarks";
        echo $res;

    }

  
elseif($statusType=="2"){
    $status = "Return Delivery";
    $displayQuery = "SELECT * FROM service WHERE email = '$email' AND customer_id = '$id'";
    $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
    $displayRows = mysqli_fetch_assoc($displayResult);
    $advance = $displayRows['advance_amount'];
    $name = $displayRows['customer_name'];
    $balanceAmount = $advance - (int) $_POST['balanceAmount'];
    if($balanceAmount<0){
        $displayQuery = "SELECT * FROM service WHERE email = '$email' AND customer_id = '$id'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_assoc($displayResult);
        $status = $displayRows['status'];
        $final = $displayRows['final_amount'];
        $advance = $displayRows['advance_amount'];
        $balance = $displayRows['balance_amount'];
        $remarks = $displayRows['remarks'];
        $res ="$final".".$balance".".$status".".$balanceAmount".".$remarks";
        echo $res;

    }
    else{

    $remarks = $_POST['remarks'];
    $remark = $_POST['remarks'];
    if($remarks!=""){
        $query = "UPDATE service SET status = '$status', advance_amount = $balanceAmount, balance_amount = 0,final_amount = 0, remarks  = '$remarks' WHERE email = '$email' AND customer_id = '$id'";
        $result = mysqli_query($con, $query) or die(mysql_error());
    }
    else{
        $query = "UPDATE service SET status = '$status', advance_amount = $balanceAmount, balance_amount = 0, final_amount = 0 WHERE email = '$email' AND customer_id = '$id'";
        $result = mysqli_query($con, $query) or die(mysql_error());
    }
       
        // $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);    
        
        $displayQuery = "SELECT * FROM service WHERE email = '$email' AND customer_id = '$id'";
        $displayResult = mysqli_query($con, $displayQuery) or die(mysql_error());
        $displayRows = mysqli_fetch_assoc($displayResult);
        $status = $displayRows['status'];
        $final = $displayRows['final_amount'];
        $advance = $displayRows['advance_amount'];
        $balance = $displayRows['balance_amount'];
        $remarks = $displayRows['remarks'];
        $returnAmount  = (int) $_POST['balanceAmount'];

        if($remark!=""){
            $query    = "INSERT into `servicehistory` (customer_name, advance,final, balance, email, customer_id,status,return_amount,remarks)
            VALUES ('$name','$advance','$final','$balanceAmount', '$email','$id','$status','$returnAmount','$remark')";
            $result   = mysqli_query($con, $query);
        }
        else{
            $query    = "INSERT into `servicehistory` (customer_name, advance,final, balance, email, customer_id,status,return_amount)
            VALUES ('$name','$advance','$final','$balanceAmount', '$email','$id','$status','$returnAmount')";
            $result   = mysqli_query($con, $query);
        }
       
    
        // $balance = $displayRows['balance_amount'];
    
        $res ="$final".".$balance".".$status".".$advance".".$remarks";
        echo $res;
    }
   
//     $td = "<thead><tr>
//     <th>SERIAL NO</th>
//     <th>CUSTOMER ID</th>
//     <th>CUSTOMER NAME</th>
//     <th>MOBILE</th>
//     <th>PLACE</th>
//     <th>COMPLAINT</th>
//     <th>ADVANCE</th>
//     <th>FINAL</th>
//     <th>BALANCE</th>
//     <th>STATUS</th>
//     <th>UPDATE</th>
// </tr></thead><tbody>";
// $serial_no = 1;
// foreach($displayRows as $displayRow){
// $td .= "<tr>
// <td >" . $serial_no++ . "</td>
// <td >" . $displayRow['customer_id'] . "</td>
// <td >" . $displayRow['customer_name']. "</td>
// <td >" . $displayRow['mobile']. "</td>
// <td >" . $displayRow['place']. "</td>
// <td >" . $displayRow['complaint']. "</td>
// <td >" .$displayRow['advance_amount']. "</td>
// <td >" .$displayRow['final_amount']. "</td>
// <td >" .$displayRow['balance_amount']. "</td>
// <td >" .$displayRow['status']. "</td>
// <td ><button class = 'status-btn' data-id = '".$displayRow['customer_id']."'>STATUS</button></td>
// </tr>";
// }
// $td .= "</tbody>";
// echo $td;
}
    
 
       
?>