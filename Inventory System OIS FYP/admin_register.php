<?php

include 'config.php';


session_start();

$admin_id = $_SESSION['admin_id'];

//If User does not Login
if(!isset($admin_id)){
	header('location:login.php');
}

//REGISTER New Admin and Dean
 //Call file to connect to server
 include ("config.php");

 //This query inserts a record in the inventory table
 //Check if form has been submitted
 if ($_SERVER ['REQUEST_METHOD'] == 'POST'){
 $error = array (); //initialize an error array

 //Check for Name
 if (empty($_POST ['name' ])){
 $error[] = 'You forgot to enter your name.';
 }
 else {
 $n = mysqli_real_escape_string ($conn, trim ($_POST ['name']));
 }

 //Check for LastName
 if (empty ($_POST[ 'email'])){
 $error [] = 'You forgot to enter your email.';
 }

 else {
     $l = mysqli_real_escape_string ($conn, trim ($_POST ['email']));
 }
 
 //Check for Insurance Number
 if (empty($_POST['password'])){
 $error [] = 'You forgot to enter your password.';
 
 }
 else {
     $i = mysqli_real_escape_string ($conn, trim ($_POST ['password' ]));
 }

 if (empty($_POST['role'])){
  $error [] = 'You forgot to enter user role.';
  
  }
  else {
      $u = mysqli_real_escape_string ($conn, trim ($_POST ['role' ]));
  }

 


 //Register the user in the database
 //Make the query
 $q = "Insert INTO users (ID, Name, Email, Password,User_Type)
 VALUES (null,'$n', '$l', '$i', '$u')";
 $result = @mysqli_query ($conn, $q); // Run the query

 if ($result){
  $success_message[] = 'User Added!';
 } 


 else{ //If it did run
 //Message
 echo '<h1>System error</hi>';

 //Debugging message
 echo '<p>'.mysqli_error($conn). '<br><br>Query: ' .$q. '</p>';
 }




}//End of the main submit conditional
 //Delete users
if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM users WHERE ID = '$id'");
  $success_message[] = 'User Deleted!';
}
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scake=1">
    <title>Register</title>

    <?php include 'sidebar.php';
          include 'message.php';
    ?>
    
    <!--Css-->
    <link rel="stylesheet" type="text/css" href="css/admin_register.css">

    <!--Boxicons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?
    family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!--Favicons-->
    <link rel="icon" type="image/x-icon" href="/Inventory System/img/icon.png">

    <!--SweetAlert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</head>
<body>

  <h1 style="   font-size: 3.5rem;
   color:#444;
   margin-bottom: 3rem;
   text-transform: uppercase;
   text-align: center;">Register</h1>

  <form method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" style="text-transform:none;"><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" style="text-transform:none;"><br><br>

    <label for="role">Role:</label>
    <select id="role" name="role">
      <option value="dean">Dean</option>
      <option value="admin">Admin</option>
    </select><br><br>

    <input type="submit" class="button-30" value="Submit">
  </form><br>

  <div style="text-align: center;">
  <table style="table-layout: fixed;height:unset;margin: 4em auto 4em auto;">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Role</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
         <!-- Loop  -->
   <?php  
         $query = mysqli_query($conn, "SELECT * FROM `users` WHERE users.User_Type='dean' OR users.User_Type='admin'") or die('query failed');
         if(mysqli_num_rows($query) > 0){
         while($products = mysqli_fetch_assoc($query)){
   ?>
      <tr>
        <td><?php echo $products['Name']; ?></td>
        <td style="text-transform:none;"><?php echo $products['Email']; ?></td>
        <td style="text-transform:none;"><?php echo $products['Password']; ?></td>
        <td><?php echo $products['User_Type']; ?></td>
        <td><a href="admin_register.php?delete=<?php echo $products['ID']; ?>" style="color:red;text-decoration:none!important;" class="button-30" > Delete </a></td>
      </tr>

      <?php }}  ?><!--End Loop  -->  

    </tbody>
  </table>
</div>

</body>
</html>
