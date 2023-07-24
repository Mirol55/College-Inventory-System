<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

//If User does not Login
if(!isset($user_id)){
	header('location:login.php');
}

//Delete product
if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM request WHERE R_ID = '$id'");
  $success_message[] = 'Deleted!';

} 

if(isset($_GET['seen'])){
  $id = $_GET['seen'];
  mysqli_query($conn, "UPDATE request SET Seen=1 WHERE R_ID = '$id'");
  $success_message[] = 'Deleted';
}

?>


<!DOCTYPE html>
<html>

<head>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Mukta:wght@300;400;600;700;800&family=Noto+Sans:wght@400;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/status.css">

  <title>Status</title>

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



<?php include 'header.php'; 
      include 'message.php';
$select_request = mysqli_query($conn, "SELECT * FROM `request` WHERE ID = '$user_id' AND Seen=0 ORDER BY R_ID DESC;") or die('query failed');
if(mysqli_num_rows($select_request) > 0){?>
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
            <?php if ($request['Status'] == 'pending'): ?>
            <p class="status status-pending">Pending</p>
            <?php elseif ($request['Status'] == 'completed'): ?>
            <p class="status status-paid">Completed</p>
            <?php elseif ($request['Status'] == 'approve'): ?>
            <p class="status status-paid">Approved</p>
            <?php else: ?>
            <p class="status status-unpaid">Rejected</p>
            <?php endif; ?>
          </td>
          <td><?php echo $request['Authorizer']; ?></td>
          <td><button class="button-30" role="button" data-target="#Req<?php echo $request['R_ID']; ?>"
              data-toggle="modal">View</button></td>
          <td><?php if ($request['Status'] != 'completed'){ ?>
            <a href="req_status.php?delete=<?php echo $request['R_ID']; ?>" style="color:red;text-decoration:none;"
              class="button-30"> Delete </a></td>
          <?php } else {?>
          <a href="req_status.php?seen=<?php echo $request['R_ID']; ?>" style="color:red;text-decoration:none;"
            class="button-30"> Delete </a></td>
          <?php } ?>

        </tr>


        <!--Popup-->
        <div class="modal fade" id="Req<?php echo $request['R_ID']; ?>" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
  <?php } else {
    Print('No records found!');
    } ?>
</body>

</html>