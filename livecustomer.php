<?php

require("db.php");
require("auth_session.php");
$email = $_SESSION['email'];
if(isset($_POST['input'])){
    $input = $_POST['input'];
    $query = "SELECT * FROM customerdetails WHERE  name  LIKE '{$input}%' AND email = '$email' OR customer_id  LIKE '{$input}%' AND email = '$email' OR mobile  LIKE '{$input}%' AND email = '$email'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $displayRows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if(mysqli_num_rows($result)>0){
        $td="<thead>
        <tr>
        <td>SERIAL NO</td>
        <td>CUSTOMER ID</td>
        <td>NAME</td>
        <td>MOBILE</td>
        <td>PLACE</td>
        <td>REMARKS</td>
        <td>UPDATE</td>
        <td>HISTORY</td>
        </tr></thead><tbody>";
        
        $serialNo = 1;
        foreach($displayRows as $row){
            $td.="
            <tr style='background-color:gray;' id='".$row['customer_id']."'>
            <td>".$serialNo++."</td>
            <td>".$row['customer_id']."</td>
            <td>".$row['name']."</td>
            <td>".$row['mobile']."</td>
            <td>".$row['place']."</td>
            <td class='rem'>".$row['remarks']."</td>  
            <td><button class = 'coll-btn' data-id = '".$row['customer_id']."'>UPDATE</button></td>
            <td><button class = 'history-btn' data-id = '".$row['customer_id']."'>HISTORY</button></td>        
            </tr>
            ";
        }
        $td.="</tbody>";
        echo $td;
    }
    else{
        $td = "<thead> <tr>
        <td>SERIAL NO</td>
        <td>CUSTOMER ID</td>
        <td>NAME</td>
        <td>MOBILE</td>
        <td>PLACE</td>
        <td>REMARKS</td>
        <td>UPDATE</td>
        <td>HISTORY</td>
        </tr></thead><tbody><tr><td colspan='8' style='text-align:center;'>No records found</td></tr><tbody>";
        echo $td;
    }
}

?>