
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/register.css">

   <!-- custom js file link  -->
   <script src="js/list.js" defer></script>

   <!--Favicons-->
   <link rel="icon" type="image/x-icon" href="/Inventory System/img/icon.png">

    <!--SweetAlert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <title>Register</title>

</head>

<body>

<!--PHP-->
<?php
    //Call file to connect to server
    include ("config.php");?>
    <?php


    //This query inserts a record in the inventory table
    //Check if form has been submitted
    if ($_SERVER ['REQUEST_METHOD'] == 'POST'){
    $error = array (); //initialize an error array
   
    //Check for Name
    if (empty($_POST ['Name' ])){
    $error[] = 'You forgot to enter your name.';
    }
    else {
    $n = mysqli_real_escape_string ($conn, trim ($_POST ['Name']));
    }

    //Check for LastName
    if (empty ($_POST[ 'Email'])){
    $error [] = 'You forgot to enter your Email.';
    }

    else {
        $l = mysqli_real_escape_string ($conn, trim ($_POST ['Email']));
    }
    
    //Check for Insurance Number
    if (empty($_POST['Password'])){
    $error [] = 'You forgot to enter your Insurance Number.';
    
    }
    else {
        $i = mysqli_real_escape_string ($conn, trim ($_POST ['Password' ]));
    }

    $u="user";


    //Register the user in the database
    //Make the query
    $q = "Insert INTO users (ID, Name, Email, Password,User_Type)
    VALUES (null,'$n', '$l', '$i', '$u')";
    $result = @mysqli_query ($conn, $q); // Run the query

    if ($result){
      echo '<script>
      myFunction();
       function myFunction() {
         alert("Registeration Completed");
         window.location = "login.php";
       }
       </script>';
    exit();
    } 


    else{ //If it did run
    //Message
    echo '<h1>System error</hi>';

    //Debugging message
    echo '<p>'.mysqli_error($conn). '<br><br>Query: ' .$q. '</p>';
    }

    mysqli_close($conn);//Close the database connection
    exit();
}//End of the main submit conditional

include 'message.php';
?>


  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        <div class="loginbackground-gridContainer">
          <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
            <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
            </div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
            <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
            <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
            <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
            <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
            <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
            <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
            <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
            <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
          </div>
        </div>
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <h1><a href="http://blog.UPTM.com/" rel="dofollow">UPTM</a></h1>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Register Account</span>

              <!--FORM-->
              <form id="stripe-login" method="POST">
              <div class="field padding-bottom--24">
                  <label for="Name">Name</label>
                  <input id="Name" type="Name" name="Name" size="30" maxlength="150" required
                  value="<?php if (isset ($_POST['Name' ])) echo $_POST ['Name'];?> " />
                </div>
                <div class="field padding-bottom--24">
                  <label for="Email">Email</label>
                  <input id="Email" type="Email" name="Email" size="30" maxlength="150" required
                  value="<?php if (isset ($_POST['Email' ])) echo $_POST ['Email'];?> " />
                </div>
                <div class="field padding-bottom--24">
                  <div class="grid--50-50">
                    <label for="Password">Password</label>
                  </div>
                  <input id="Password" type="Password" name="Password" size="30" maxlength="150" required
                  value="<?php if (isset ($_POST['Password' ])) echo $_POST ['Password'];?>" />
                </div>
                <div class="field padding-bottom--24">
                  <input id="submit" type="submit" name="submit" value="Continue">
                </div>
                <div class="field">
                  <a class="ssolink" href="login.php">Login</a>
                </div>
              </form>
              <!--FORM-->
            </div>
          </div>
          <div class="footer-link padding-top--24">
            <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
              <span><a href="#">© UPTM</a></span>
              <span><a href="#">Contact</a></span>
              <span><a href="#">Privacy & terms</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>