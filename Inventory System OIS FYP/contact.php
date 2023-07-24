<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

//If User does not Login
if(!isset($user_id)){
	header('location:login.php');
}

if(isset($_POST['submit']))
{    
    
     $name = $_POST['name'];
     $email = $_POST['email'];
     $phone = $_POST['phone'];
     $msg = $_POST['msg'];
     $sql = "INSERT INTO contact (ID,Name,Email,P_Num,Msg)
     VALUES (null,'$name','$email','$phone','$msg')";
     if (mysqli_query($conn, $sql)) {
        $success_message[] = 'Message submitted';
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
     mysqli_close($conn);
}
?>



<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scake=1">
    <title>Contact</title>

    <link rel="stylesheet" type="text/css" href="css/contact.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?
    family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!--Favicons-->
   <link rel="icon" type="image/x-icon" href="/Inventory System/img/icon.png">

    <!--SweetAlert-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</head>


<body>
<?php include 'header.php'; 
      include 'message.php'; ?>
<?php
    //Call file to connect to server
    include ("config.php");
?>

    <div class="container">
        <div class="row">
                <h1 style="   font-size: 3.5rem; color:#444;margin-bottom: 3rem;text-transform: uppercase;text-align: center;">Contact Us</h1>
        </div>

<!--Action is where to send the post data-->
<form action="contact.php" method="post">
        <div class="row input-container">
                <div class="col-xs-12">
                    <div class="styled-input wide">
                        <input type="text" placeholder="Name" value="<?php echo $_SESSION['user_name']; ?>" name=name required style="text-transform:none!important;"/>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="styled-input">
                        <input type="text" placeholder="Email" name=email value="<?php echo $_SESSION['user_email']; ?>" required style="text-transform:none!important;"/>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="styled-input" style="float:right;">
                        <input type="text" placeholder="Phone Number" name=phone required style="text-transform:none!important;" maxlength="11"/>

                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="styled-input wide">
                        <textarea placeholder="Message" name=msg required style="text-transform:none!important;"></textarea>

                    </div>
                </div>
                <div class="col-xs-12">
                    <input type="submit" class="submit-btn" name="submit" value="Submit">
                </div>
        </div>
<form>
    </div>
    
</body>
</html>
