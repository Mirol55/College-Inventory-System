<html>

<head>
  <title>Mirol Cafe</title>
  <link rel="stylesheet" href="loginstyle.css">

  <link href="https://fonts.googleapis.com/css2?
      family=Roboto:wght@400;700&display=swap">

  <link rel="icon" type="image/x-icon" href="/Mirol/favicon2.png">


</head>

<body>

  <!--Databse-->
  <?php

//Call file to connect server to mirol_cafe
include("header.php");
?>

  <?php

error_reporting(0);

//This section processes submission from the login form
//Check if the form has been submitted

if(isset($_POST['submit2'])){

//Validate the username
if(!empty($_POST['Email'])){

    $e=mysqli_real_escape_string($connect,$_POST['Email']);

}

else{

    $e=FALSE;
    echo'<p class="error">You forgot to enter your Email.</P>';

}
//Validate the password
if(!empty($_POST['Password'])){

    $p=mysqli_real_escape_string($connect,$_POST['Password']);


}
else{
    $p=FALSE;
    echo '<p class="error">You forgot to enter your password.</P>';
}

//If no problem
if($e&&$p){


//Retrieve the ID,firstname,lastname for the username and password combination
    $q="SELECT ID,FirstName,LastName , Password,Email From admin WHERE (Email='$e' AND Password='$p')";

//Run the query and assigned it into variable $result
    $result=mysqli_query($connect,$q);

//Count the number of rows that match the username/password combination
//If one database row(record) matches the input:


    if(@mysqli_num_rows($result)==1){

        //Start the session,fetch the record and insert
        session_start();
        $_SESSION=mysqli_fetch_array($result,MYSQLI_ASSOC);
        header('Location:admin_home.html');


        exit();

        mysqli_free_result($result);
        mysqli_close($connect);



    }
//No match was made
    else{

      echo '<script>alert("Wrong Email or Password,Please try again")</script>';

    }

}
//If there was a problem
else{

echo '<p class="error">Please try again.</p>';

}


}//End of submit conditional


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



//Registerr Database

    //This query inserts a record in the clinic table
    //Check if form has been submitted
    if(isset($_POST['submit1'])){
      $error = array (); //initialize an error array
     
      //Check for Name
      if (empty($_POST ['FirstName' ])){
      $error[] = 'You forgot to enter your first Name.';
      }
      else {
      $n = mysqli_real_escape_string ($connect, trim ($_POST ['FirstName']));
      }
  
      //Check for Name
      if (empty ($_POST[ 'LastName'])){
      $error [] = 'You forgot to enter your last name.';
      }
  
      else {
          $l = mysqli_real_escape_string ($connect, trim ($_POST ['LastName']));
      }
      
      //Check for Password
      if (empty($_POST['Password'])){
      $error [] = 'You forgot to enter your Password.';
      
      }
      else {
          $p = mysqli_real_escape_string ($connect, trim ($_POST ['Password' ]));
      }
  
      //Check for Diagnose
      if (empty($_POST[ 'Email' ])){
      $error [] = 'You forgot to enter your Email.';
      }
      else {
      $e = mysqli_real_escape_string ($connect, trim ($_POST ['Email']));
      }
  
      //Register the user in the database
      //Make the query
      $q = "Insert INTO admin (ID, FirstName,LastName,Password,Email)
      VALUES (null,'$n', '$l', '$p', '$e')";
      $result = @mysqli_query ($connect, $q); // Run the query
  
      if ($result){
        header('Location:newlogin.php');
        echo '<script>alert("Register Complete")</script>';
      } 
  
  
      else{ //If it did run
      //Message
      echo '<h1>System error</hi>';
  
      //Debugging message
      echo '<p>'.mysqli_error($connect). '<br><br>Query: ' .$q. '</p>';
      }
  
      mysqli_close($connect);//Close the database connection
      exit();
  }//End of the main submit conditional

//


?>
  <!--<Close databse>-->




  <div class="hero">
    <div class="form-box">
      <div class="button-box">
        <div id="btn"></div>
        <button type="button" class="toggle-btn" onclick="login()">Login</button>
        <button type="button" class="toggle-btn" onclick="register()">Register</button>
      </div>
      <!--<Close button-box>-->
      <div class="social-icons">
        <img src="/Mirol/favicon2.png">
      </div>
      <!--<Close sosial-icons>-->
      <form id="login" class="input-group" action="newlogin.php" method="post">
        <input id="Email" type="text" name="Email" class="input-field" placeholder="Email" required
          value="<?php if (isset($_POST['Email'])) echo $_POST ['Email'];?>">
        <input id="Password" type="Password" name="Password" class="input-field" placeholder="Enter Password" required
          value="<?php if(isset($_POST['Password'])) echo $_POST['Password'];?>">
        <input type="checkbox" class="chech-box"><span>Remember Password</span>
        <button type="submit" class="submit-btn" id="submit" name="submit2">Login</button>


        <!--<Close form-box>-->
      </form>
      <form id="register" class="input-group" action="newlogin.php" method="post">

        <input type="text" class="input-field" placeholder="First Name" required id="FirstName" type="text"
          name="FirstName" size="30" maxlength="150"
          alue="<?php if (isset ($_POST['FirstName' ])) echo $_POST ['FirstName'];?> " />

        <input type="text" class="input-field" placeholder="Last Name" required id="LastName" type="text"
          name="LastName" size="30" maxlength="150"
          alue="<?php if (isset ($_POST['LastName' ])) echo $_POST ['LastName'];?> " />

        <input type="email" class="input-field" placeholder="Email Id" required id="Email" type="text" name="Email"
          size="30" maxlength="150" value="<?php if (isset ($_POST['Email' ])) echo $_POST ['Email'];?> " />

        <input type="text" class="input-field" placeholder="Enter Password" required id="Password" type="text"
          name="Password" size="30" maxlength="150"
          alue="<?php if (isset ($_POST['Password' ])) echo $_POST ['Password'];?> " />

        <input type="checkbox" class="chech-box"><span>I Agree to the terms & conditions</span>
        <button type="submit" class="submit-btn" id="submit" name="submit1">Register</button>

      </form>
    </div>
    <!--<Close form-box>-->
  </div>
  <!--<Close hero>-->

  <script>
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    var z = document.getElementById("btn");

    function register() {

      x.style.left = "-400px";
      y.style.left = "50px";
      z.style.left = "110px";

    }

    function login() {

      x.style.left = "50px";
      y.style.left = "450px";
      z.style.left = "0px";

    }

  </script>



</body>

</html>