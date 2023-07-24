<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

//If User does not Login
if(!isset($user_id)){
	header('location:login.php');
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scake=1">
    <title>KUPTM INVENTORY</title>

    <link rel="stylesheet" type="text/css" href="css/Home.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?
    family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!--Favicons-->
   <link rel="icon" type="image/x-icon" href="/Inventory System/img/icon.png">

</head>

<body>

 <?php include 'header.php' ?>

    <!--Home -->
    <section class="home" id="home">
        <div class="home-text">
            <h1>Welcome To <span>UPTM <br>Office Inventory System</span></h1>
            <p style="font-size:20px;">Need Something?,Request Now </p>
            <a href="List.php" class="btn">Request</a>
        </div>



    <!--Main Pic -->
        <div class="home-img">
            <img src="/Inventory System/img/UPTM.png">
        </div>



    </section>

    <!--Container -->
    <section class="container">
        <div class="main-text ">

            <h2 >Why Us?</h2>

        </div>

        <div class="container-box">
            <!--FIrst -->
            <div class="c-mainbx">
                <div class="container-img">
                <i class='bx bx-fast-forward' style="font-size:20px;"></i>
                </div>
                <!--CI END -->

                <div class="container-text">
                    <p>Fast</p>
                </div>
            </div>
            <!--CB END -->

            <!--Second -->
            <div class="c-mainbx">
                <div class="container-img">
                <i class='bx bxs-timer' style="font-size:20px;"></i>
                </div>
                <!--CI END -->

                <div class="container-text">
                    <p>Efficient</p>
                </div>


            </div>
            <!--CB END -->


            <!--Third -->
            <div class="c-mainbx">
                <div class="container-img">
                <i class='bx bxs-home-alt-2' style="font-size:20px;"></i>
                </div>
                <!--CI END -->

                <div class="container-text">
                    <p>Organized</p>
                </div>


            </div>
            <!--CB END -->


        </div>



    </section>


    <!--About Us -->
    <section class="about" id="about">
        <div class="about-img">
            <img src="/Inventory System/img/uptm1.jpg" style="border-radius:30px;">
        </div>

        <div class="about-text">
            <h2>About Us</h2>
            <p style="font-size:15px;">UPTM OIS is an inventory system.This system is built solely purpose to help UPTM staff to request office equipment from the inventory department </p>
            <a href="List.php" class="btn">Request</a>
        </div>
    </section>




    </section>
    <!--Contact -->
    <section class="contact" id="contact">
        <div class="main-contact">

            <div class="contact-content">
                <h4>Services</h4>
                <li><a href="OIS USER MANUAL.pdf" target="_blank">Users Manual</a></li>
            </div>

  

            <div class="contact-content">
                <h4>Contact Us</h4>
                <li><a href="https://www.google.com/maps/place/5,+Jalan+Lembah+17,+Bandar+Baru+Seri+Alam,+81750+Masai,+Johor/data=!4m2!3m1!1s0x31da6b0191ab3561:0xbf6a69cf631a610c?sa=X&ved=2ahUKEwjVqOTnsYn7AhVH-DgGHZmdCVgQ8gF6BAgNEAE"  target="_blank"> Jalan 6/91, Taman Shamelin Perkasa, 56100 Cheras, Kuala Lumpur</a></li>
                <li><a href="">Mon - Fri: 9am - 5pm</a></li>
                <li><a href="mailto:uptmkl.hq@gmail.com">uptmkl.hq@gmail.com</a></li>
                <li><a href=" https://wa.me/073864511" target="_blank">+603 9206 9700 </a></li>
            </div>

            <div class="contact-content">
                <h4>Follow Us</h4>
                <li><a href="#home">Facebook</a></li>
                <li><a href="#about">Instagram</a></li>
            </div>

        </div>

    </section>


    <!--Last Text -->

    <div class="last-text">
        <p>@2023UPTM OIS.All Rights Reserved by Amierul Syafiq</p>
        <p>Last modified (22/3/2023)</p>
    </div>

    <!--Scroll top -->
    <a href="#home" class="scroll-top"><i class='bx bxs-graduation'></i></a>


    <!--JavaScript -->
    <script type="text/javascript" src="script.js"></script>


</body>

</html>