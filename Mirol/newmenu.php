<?php
//Connect to mirol_cafe database
include 'connect.php';

//If product added to cart
if(isset($_POST['add_to_cart'])){

   $product_id = $_POST['product_id'];
   $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

   $verify_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $verify_product->execute([$product_id]);

   if($verify_product->rowCount() > 0){

      $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE product_id = ? AND user_id = ?");
      $verify_cart->execute([$product_id, $user_id]);

      if($verify_cart->rowCount() > 0){
         $warning_message[] = 'already added to cart!';
      }else{
         $id = create_unique_id();
         $qty = $_POST['qty'];
         $qty = filter_var($qty, FILTER_SANITIZE_STRING);

         $insert_cart = $conn->prepare("INSERT INTO `cart`(id, user_id, product_id, qty) VALUES(?,?,?,?)");
         $insert_cart->execute([$id, $user_id, $product_id, $qty]);
         $success_message[] = 'added to cart!';
      }

      
   }else{
      $error_message[] = 'something went wrong!';
   }

}

//Calculate total items
$count_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
$count_cart->execute([$user_id]);
$total_cart_items = $count_cart->rowCount();

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scake=1">
    <title>Menu</title>
    <link rel="stylesheet" type="text/css" href="menustyle29.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?
    family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="/Mirol/favicon2.png" >



</head>
<body>
<section>

<div class="count-container">
   <p>Total Cart Items : <span><?= $total_cart_items; ?></span></p>
   <a href="cart.php" class="inline-btn <?= ($total_cart_items > 1)?'':'disabled'; ?>">view cart</a>
</div>

</section>



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
            <a href="cart.php"><i class='bx bxs-cart'></i></a>
            <a href="newlogin.php"><i class='bx bxs-user'></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
        
        </div>
        
    </header>
    <!--Header Section-->

    <div class="heading">
            <br><br><h1>Mirol's Cafe</h1>
            <h3>&mdash;MENU&mdash;</h3>
    </div>


    <div class="menu">

    <?php
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
    ?>


    <form action="" class="box" method="POST">        

        <div class="food-items">
        <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>">

        <img class="food-items" src="uploaded_img/<?= $fetch_product['image']; ?>" alt="">

            <div class="details">
                <div class="details-sub">

                    <h3 class="name"><?= $fetch_product['name']; ?></h3>
                    <div class="flex">
                    RM<span class="price"><?= $fetch_product['price']; ?></span>
                    <input type="number" name="qty" class="qty" max="99" min="1" maxlength="2" required value="1">
                     </div>

                </div>
                <p></p>
                <input type="submit" value="Add to cart" name="add_to_cart" class="butn">


            </div>

        </div>


    </form>
    <?php
   }
   }else{
      echo '<p class="emtpy">no products added yet!</p>';
   }
   ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>

   document.querySelectorAll('input[type="number"]').forEach(inputNumbmer => {
      inputNumbmer.oninput = () =>{
         if(inputNumbmer.value.length > inputNumbmer.maxLength) inputNumbmer.value = inputNumbmer.value.slice(0, inputNumbmer.maxLength);
      }
   });

</script>
   
<?php include 'message.php'; ?>

    


</body>
</html>