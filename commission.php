<?php
require("auth_session.php");
require("db.php");
$email = $_SESSION['email'];

if(isset($_POST['fromDate']) && isset($_POST['toDate'])){

    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $query = "SELECT * FROM daily WHERE email = '$email'";
    $result  = mysqli_query($con, $query);
    $rows  = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $td="<h3 style  = 'text-align:center;'>Recharge</h3>";
    foreach($rows as $row){
        $id  = $row['id'];
        $query = "SELECT * FROM rechargehistory WHERE email = '$email' AND id = '$id' AND date between '$fromDate' AND '$toDate'";
        $result = mysqli_query($con, $query);
        $rows2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $rechargeAmount = 0;
        $balanceAmount = 0;
        $flag = false;
        $flag2 = false;
        foreach($rows2 as $row2){
            $flag2=true;
           $commission = $row2['commission'];
            if($row2['status']==2){
                $flag = true;
            }
        }
        if(!$flag && $flag2){
    
      
        $cls = "black";
        if($commission>0){
            $cls = "pos";
        }
    
    $td.="
    <div class = 'accs''>
    <p>".$row['item']."</p>
    <p>&#8377; <span class='recharge-commission ".$cls."'>".$commission."</span></p>
    </div> 
    ";
    }
    
    }
    echo $td;
}
else{
$date = date("Y-m-d");
$query = "SELECT * FROM daily WHERE email = '$email'";
$result  = mysqli_query($con, $query);
$rows  = mysqli_fetch_all($result, MYSQLI_ASSOC);
$td="<h3 style  = 'text-align:center;'>Recharge</h3>";
foreach($rows as $row){
    $id  = $row['id'];
    $query = "SELECT * FROM rechargehistory WHERE email = '$email' AND id = '$id' AND date = '$date'";
    $result = mysqli_query($con, $query);
    $rows2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $rechargeAmount = 0;
    $balanceAmount = 0;
    $flag = false;
    $flag2 = false;
    foreach($rows2 as $row2){
        $flag2=true;
       $commission = $row2['commission'];
        if($row2['status']==2){
            $flag = true;
        }
    }
    if(!$flag && $flag2){

  
    $cls = "black";
    if($commission>0){
        $cls = "pos";
    }

$td.="
<div class = 'accs''>
<p>".$row['item']."</p>
<p>&#8377; <span class='recharge-commission ".$cls."'>".$commission."</span></p>
</div> 
";
}

}
echo $td;
}

?>