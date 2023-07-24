<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

//If User does not Login
if(!isset($admin_id)){
	header('location:login.php');
}



//Change Status To Complete
if(isset($_GET['complete'])){
  mysqli_query($conn, "UPDATE request SET request.Status = 'completed' WHERE R_ID =". $_GET['complete']) or die('query failed');
  $success_message[] = 'Request Completed';
}


?>

<!DOCTYPE html>
<html>

<head>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Mukta:wght@300;400;600;700;800&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/status.css">

  <!--Popup-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  
  <!--Favicons-->
  <link rel="icon" type="image/x-icon" href="/Inventory System/img/icon.png">

    <!--SweetAlert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


</head>

<body>
<?php include 'sidebar.php';
      include 'message.php';



$select_request = mysqli_query($conn, "SELECT * FROM request WHERE request.Status = 'approve' ORDER BY R_ID DESC;") or die('query failed');
if(mysqli_num_rows($select_request) > 0){


?>


<div style="margin-bottom: 130px;padding-top:120px;">
  <h3 style="   font-size: 4.5rem; color:#444;margin-bottom: 3rem;text-transform: uppercase;text-align: center;">Status</h3>
    <table style="table-layout: fixed;height:unset;margin-bottom: 5em;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Date</th>
        <th>Status</th>
        <th>Authorizer</th>
        <th>Order</th>
        <th>Action</th>
        
             
      </tr>
      
    </thead>
    <tbody>
      
    <?php
          while($request = mysqli_fetch_assoc($select_request)){
      ?>
    <!--Row 1-->
      <tr>
        <td><a href="#">INV_0<?php echo $request['R_ID']; ?></a></td>
        <td><?php echo $request['Name']; ?></td>
        <td><?php echo $request['Date_Field']; ?></td>
        <td>
        <p class="status status-paid"><?php echo $request['Status'].'d'; ?></p>
        </td>
        <td><?php echo $request['Authorizer']; ?></td>

        <td><button class="button-30" role="button" data-target="#Req<?php echo $request['R_ID']; ?>" data-toggle="modal">View</button></td>
        <td><button class="button-30" role="button" style="width:100px;color:green;" onclick="location.href='<?php echo strtok($_SERVER["REQUEST_URI"], '?') . '?complete='.$request['R_ID']; ?>';" >Complete</button></td>
      </tr>

    <!--Popup-->
    <div class="modal fade" id="Req<?php echo $request['R_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Requested Equipments</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           <?php echo $request['Request']; ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <?php } ?>

    </tbody>
    </table>
          </div>

    <?php } 
    
    else {
    Print('No records found!');
    } ?>
  
    </body>
    </html>
