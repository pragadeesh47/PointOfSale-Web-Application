<?php
    require('db.php');
    require('auth_session.php');
    // When form submitted, check and create user session.

    if(isset($_POST['fromDate']) && (isset($_POST['toDate']))){
        $email = $_SESSION['email'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $query = "SELECT * FROM detailshistory WHERE email = '$email' AND saleOrpurchase = 'expense' AND date BETWEEN '$fromDate' AND '$toDate'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $td = " <thead><tr>
        <th>SERIAL NO</th>
        <th>ITEM</th>
        <th>PRICE</th>
        <th>REMARKS</th>
    </tr></thead><tbody>";
    $amount = 0;

    $serialNumber = 1;

        foreach ($rows as $row) {
           $td .=
            "<tr>
            <td>".$serialNumber++."</td>
            <td>". $row['item']."</td>
            <td>".$row['price']."</td>
            <td>".$row['remarks']."</td>
            </tr>";
            $amount += $row['price'];
          }
          $td.="</tbody>";
          $total = $td .=".$amount";
          echo $total;
           
    }

    else{
        $date = date("Y-m-d");
        $email = $_SESSION['email']; 
        $query = "SELECT * FROM `detailshistory` WHERE email='$email' and saleOrpurchase = 'expense' AND date = '$date'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $td = "<thead> <tr>
        <th>SERIAL NO</th>
        <th>ITEM</th>
        <th>PRICE</th>
        <th>REMARKS</th>
    </tr></thead><tbody>";
    $amount = 0;
    $serialNumber = 1;
        foreach ($rows as $row) {
           $td .=
            "<tr>
            <td>".$serialNumber++."</td>
            <td>". $row['item']."</td>
            <td>".$row['price']."</td>
            <td>".$row['remarks']."</td>
            </tr>";
        $amount += $row['price'];
          }
    $td .= "</tbody>";
    $total = $td .=".$amount";
    echo $total;
    }

 
       
?>