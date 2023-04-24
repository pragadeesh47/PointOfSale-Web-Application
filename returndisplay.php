<?php
    require('db.php');
    require('auth_session.php');
    // When form submitted, check and create user session.

    if(isset($_POST['fromDate']) && (isset($_POST['toDate']))){
        $email = $_SESSION['email'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $query = "SELECT * FROM salereturn WHERE email = '$email' AND date BETWEEN '$fromDate' AND '$toDate'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

       
        $td = "<thead> <tr>
        <th>SERIAL NO</th>
        <th>ITEM</th>
        <th>QUANTITY</th>
        <th>PRICE</th>
        <th>REMARKS</th>
    </tr></thead><tbody>";
    $serialNumber = 1;
        foreach ($rows as $row) {
           $td .=
            "<tr>
            <td>".$serialNumber++."</td>
            <td>". $row['product']."</td>
            <td>".$row['quantity']."</td>
            <td>".$row['price']."</td>
            <td>".$row['remarks']."</td>
            </tr>";
          }
    $td .= "</tbody>";
          echo $td  ;
           
    }

    else{
        $email = $_SESSION['email']; 
        $date = date("Y-m-d");
        $query = "SELECT * FROM `salereturn` WHERE email='$email' AND date = '$date' ";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $td = "<thead><tr>
        <th>SERIAL NO</th>
        <th>ITEM</th>
        <th>QUANTITY</th>
        <th>PRICE</th>
        <th>REMARKS</th>
    </tr></thead><tbody>";
    $serialNumber = 1;
        foreach ($rows as $row) {
           $td .=
            "<tr>
            <td>".$serialNumber++."</td>
            <td>". $row['product']."</td>
            <td>".$row['quantity']."</td>
            <td>".$row['price']."</td>
            <td>".$row['remarks']."</td>
            </tr>";
          }
    $td .= "</tbody>";
    echo $td;
    }

 
       
?>