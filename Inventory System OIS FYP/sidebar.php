<?php

include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    
     <!-- custom css file link  -->
     <link rel="stylesheet" href="css/header.css">

    <!--Boxicons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!--Favicons-->
    <link rel="icon" type="image/x-icon" href="/Inventory System/img/icon.png">

</head>
<body>
    
<!-- header section starts  -->

<header class="header">

    <a href="#" class="logo" style="text-decoration:none!important;"> <i class='bx bxs-graduation'></i> OIS <span style="font-size:15px;text-decoration:none!important;">Admin~</span></a>

    <nav class="navbar">
        <a style="text-decoration:none!important;" href="Admin.php">HOME</a>
        <a style="text-decoration:none!important;" href="admin_list.php">REQUEST</a>
        <a style="text-decoration:none!important;" href="admin_status.php">STATUS</a>
        <a style="text-decoration:none!important;" href="admin_contact.php">CONTACT</a>
        <a style="text-decoration:none!important;" href="admin_register.php">REGISTER</a>
    </nav>

    <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <div class="fas fa-search" id="search-btn" style="display: none;"></div>
        <a href="OIS USER MANUAL.pdf"  target="_blank"><div class="fas fa-book" id="cart-btn"></div></a>
        <div class="fas fa-user" id="login-btn"></div>
    </div>

    <form action="" class="search-form">
        <input class="search-form-input" type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search search-form-button"></label>
    </form>


<!--Login-->



    <form action="" class="login-form">
        <h3>Welcome</h3>
        <h4 class="box"><?php echo $_SESSION['admin_name']; ?></h4>
        <h4 class="box"><?php echo $_SESSION['admin_email']; ?></h4>
        <a href="logout.php" tite="Logout" class="butone" style="text-decoration:none!important;">Logout</a>
    </form>

    <!-- custom js file link  -->
    <script src="js/header.js"></script>


</header>
</body>
</html>