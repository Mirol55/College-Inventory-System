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

    <!--Boxicons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/header.css">

</head>
<body>
    
<!-- header section starts  -->

<header class="header">

    <a href="#" class="logo" style="text-decoration:none!important;"> <i class='bx bxs-graduation'></i> OIS </a>

    <nav class="navbar">
        <a style="text-decoration:none!important;" href="Home.php">HOME</a>
        <a style="text-decoration:none!important;" href="List.php">REQUEST</a>
        <a  style="text-decoration:none!important;" href="req_status.php">STATUS</a>
        <a  style="text-decoration:none!important;" href="contact.php">CONTACT</a>
    </nav>

    <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <div class="fas fa-search" id="search-btn"></div>
        <a href="cart.php"><div class="fas fa-shopping-cart" id="cart-btn"></div></a>
        <div class="fas fa-user" id="login-btn"></div>
    </div>

    <form action="List.php" method="GET" class="search-form">
        <input class="search-form-input" type="search"  name="search" id="search-box" placeholder="search here...">
        <button type="submit"  style="background-color:white;">
        <label for="search-box" class="fas fa-search search-form-button"></label>
        </button>
    </form>


<!--Login-->



    <form action="" class="login-form">
        <h3>Welcome</h3>
        <h4 class="box"><?php echo $_SESSION['user_name']; ?></h4>
        <h4 class="box"><?php echo $_SESSION['user_email']; ?></h4>
        <a style="text-decoration:none!important;" href="logout.php" tite="Logout" class="butone" >Logout</a>
    </form>

    <!-- custom js file link  -->
    <script src="js/header.js"></script>


</header>
</body>
</html>