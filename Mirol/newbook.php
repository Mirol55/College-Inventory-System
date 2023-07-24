<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link rel="stylesheet" href="bookstyle.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" type="image/x-icon" href="/Mirol/favicon2.png" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?
    family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">


</script>
</head>

<body>

    <?php
    //Call file to connect to server
    include ("header.php");?>
    <?php


    //This query inserts a record in the book table
    //Check if form has been submitted
    if ($_SERVER ['REQUEST_METHOD'] == 'POST'){
    $error = array (); //initialize an error array
   
    //Check for Name
    if (empty($_POST ['Name' ])){
    $error[] = 'You forgot to enter your Name.';
    }
    else {
    $n = mysqli_real_escape_string ($connect, trim ($_POST ['Name']));
    }

    //Check for Address
    if (empty ($_POST[ 'Address'])){
    $error [] = 'You forgot to enter your address';
    }

    else {
        $a = mysqli_real_escape_string ($connect, trim ($_POST ['Address']));
    }
    
    //Check for Date
    if (empty($_POST['Date'])){
    $error [] = 'You forgot to enter your booking date.';
    
    }
    else {
        $d = mysqli_real_escape_string ($connect, trim ($_POST ['Date' ]));
    }

    //Check for Pax
    if (empty($_POST[ 'Pax' ])){
    $error [] = 'You forgot to enter number of PAX.';
    }
    else {
        $p = mysqli_real_escape_string ($connect, trim ($_POST ['Pax']));
    }

    //Check for Time
    if (empty($_POST[ 'Time' ])){
            $error [] = 'You forgot to enter Note.';
    }
        else {
        $t = mysqli_real_escape_string ($connect, trim ($_POST ['Time']));
    }

    //Check for Note
    if (empty($_POST[ 'Note' ])){
        $error [] = 'You forgot to enter Note.';
    }
        else {
        $nt = mysqli_real_escape_string ($connect, trim ($_POST ['Note']));
    }



    //Register the user in the database
    //Make the query
    $q = "Insert INTO book (ID_C,Name, Address, Date, Pax,Time,Note)
    VALUES (null,'$n', '$a', '$d', '$p','$t','$nt')";
    $result = @mysqli_query ($connect, $q); // Run the query

    if ($result){
    echo '<script>alert("Wrong Email Or Password")</script>';
    header('Location:newbook.php');
    //exit();
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

?>

    <!--Header Section-->
    <header>

<a href="#" class="logo">Mirol's<span>  Cafe</span></a>


<ul class="navbar">
    <li><a href="Home.html">Home</a></li>
    <li><a href="Home.html#about">About Us</a></li>
    <li><a href="newmenu.php">Menu</a></li>
    <li><a href="Home.html#contact">Contact</a></li>

</ul>
</div>

<div class="h-icons">
    <a href="#"><i class='bx bx-search'></i></a>
    <a href="#"><i class='bx bxs-cart'></i></a>
    <a href="newlogin.php"><i class='bx bxs-user'></i></a>
    <div class="bx bx-menu" id="menu-icon"></div>

</div>

</header>




<!-- This is main Form Area Start ++ -->
<div class="bf-container">

    <!-- Main form Body Start -->
    <div class="bf-body">


        <!-- Form haed -->
        <div class="bf-head">
            <h1>Mirol's Cafe</h1>
            <p>Booking Form</p>
        </div>
        <!-- Form haed -->


        <!-- Form Body Box -->
        <form class="bf-body-box" name="myForm" method="post" onsubmit="return validateForm()" required>

            <div class="bf-row">

                <div class="bf-col-6">
                    <p>Your Name</p>
                    <input id="Name" type="text" name="Name" size="30" maxlength="150"
                     value="<?php if (isset ($_POST['Name' ])) echo $_POST ['Name'];?> " />
                </div>
                <div class="bf-col-6">
                    <p>Email Address</p>
                    <input id="Address" type="text" name="Address" size="30" maxlength="150"
                     value="<?php if (isset ($_POST['Address' ])) echo $_POST ['Address'];?> " />
                </div>


            </div>



            <div class="bf-row">

                <div class="bf-col-6">
                    <p>Select Date</p>
                    <input id="Date" type="date" name="Date" size="30" maxlength="150"
                     value="<?php if (isset ($_POST['Date' ])) echo $_POST ['Date'];?> " />
                </div>

                
                
                <div class="bf-col-6">
                    <p>PAX</p>
                    <input id="Pax" type="text" name="Pax" size="30" maxlength="150"
                     value="<?php if (isset ($_POST['Pax' ])) echo $_POST ['Pax'];?> " />
                </div>



            </div>

            <div class="bf-col-6">
                    <p>Time</p>
                    <input id="Time" type="time" name="Time" size="30" maxlength="150" min="8:00" max="22:00" step="900"
                     value="<?php if (isset ($_POST['Time' ])) echo $_POST ['Time'];?> " />
            </div>

            <div class="bf-row">

                <div class="bf-col-12">
                    <p>Messages</p>
                    <textarea name="Note" id="Note" rows="5" cols="10"> <?php if (isset ($_POST[ 'Note' ])) 
                     echo $_POST ['Note']; ?></textarea>

                </div>




            </div>



            <div class="bf-row">
                <div class="bf-col-3">
                <input id="submit" type="submit" names="submit" value="Register" />
                </div>

            </div>


        </form>
        <!-- Form Body Box -->

        <!-- This Is For Footer Start -->
        <div class="bf-footer">
            <p>© 2020 Mirol's Cafe</p>
        </div>
        <!-- This Is For Footer End -->


    </div>
    <!-- Main form Body End -->


</div>
<!-- This is main Form Area  End -->



<!--Contact -->
<section class="contact" id="contact">
<div class="main-contact">

<div class="contact-content">
    <h4>Services</h4>
    <li><a href="#home">Home</a></li>
    <li><a href="#about">About Us</a></li>
    <li><a href="#menu">Menu</a></li>
    <li><a href="#contact">Contact</a></li>
</div>  

<div class="contact-content">
    <h4>Partner</h4>
    <li><a href="#home">Food Panda</a></li>
    <li><a href="#about">Grab Food</a></li>
    <li><a href="#menu">Shopee</a></li>
</div> 

<div class="contact-content">
    <h4>Contact Us</h4>
    <li><a href="#home">Home</a></li>
    <li><a href="#about">About Us</a></li>
    <li><a href="#menu">Menu</a></li>
    <li><a href="#contact">Contact</a></li>
</div> 

<div class="contact-content">
    <h4>Follow Us</h4>
    <li><a href="#home">Facebook</a></li>
    <li><a href="#about">Instagram</a></li>
</div> 

</div>



</section>

<!--Validate Form-->
<script>
function validateForm() {
  var x = document.forms["myForm"]["Name"].value;
  if (x == "" || x == null) {
    alert("Name must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["Address"].value;
  if (x == "" || x == null) {
    alert("Email address must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["Date"].value;
  if (x == "" || x == null) {
    alert("Date must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["Pax"].value;
  if (x == "" || x == null) {
    alert("Pax must be filled out");
    return false;
  }

  var x = document.forms["myForm"]["Time"].value;
  if (x == "" || x == null) {
    alert("Time must be specified");
    return false;
  }
}
</script>




</body>

</html>