<?php
 require("db.php");
 require("auth_session.php");
$email = $_SESSION['email'];
 $date = $_POST['date'];
 $query = "SELECT * FROM daily WHERE email = '$email'";
 $result  = mysqli_query($con, $query);
 $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
 foreach($rows as $row){
 $entryDate = $row['date'];
 $id = $row['id'];
 if($date!=$entryDate){
    $query = "UPDATE daily SET opening = '0', purchase = '0', closing = '0', profit = '0' WHERE email = '$email' AND id = '$id'";
    $result  = mysqli_query($con, $query);
}
    
//     $email = $_SESSION['email'];
// $query = "SELECT * FROM daily WHERE email = '$email'";
// $result = mysqli_query($con, $query);
// $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

// $td = "
// <thead>
// <tr>
// <th>SERIAL NO</th>
// <th>ITEM ID</th>
// <th>ITEM</th>
// <th>OPENING</th>
// <th>PURCHASE</th>
// <th>CLOSING</th>
// <th>SALES</th>
// <th>UPDATE</th>
// <th>HISTORY</th>
// </tr>
// </thead><tbody>
// ";
// $serial = 1;

// foreach($rows as $row){
//     $td.="
//     <tr id = '".$row['id']."'>
//     <td>".$serial++."</td>
//     <td>".$row['id']."</td>
//     <td>".$row['item']."</td>
//     <td class = 'opn'>".$row['opening']."</td>
//     <td class = 'prs'>".$row['purchase']."</td>
//     <td class = 'cls'>".$row['closing']."</td>
//     <td class = 'prft'>".$row['profit']."</td>
//     <td><button class = 'coll-btn' data-id = '".$row['id']."'>UPDATE</button></td>
//     <td><button class = 'history-btn' data-id = '".$row['id']."'>HISTORY</button></td>
//     </tr>
//     ";
// }

// $td.="</tbody>";
// echo $date."$entryDate";

 }



?>