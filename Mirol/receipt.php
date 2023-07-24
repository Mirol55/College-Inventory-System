<?php

include 'connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Receipt</title>
   <link rel="icon" type="image/x-icon" href="/Mirol/favicon2.png" >

   <!-- Font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- Custom css file link  -->
   <link rel="stylesheet" href="cartstyle2.css">

</head>
<body>


<section class="products">

   <h1 class="heading">Thank <span>You</span></h1>
   <h2>Dear user thank you for ordering with us.We will notify you when our rider is on your way!</h2>

   <div class="box-container">
<!--Total-->
   <?php
      $grand_total = 0;
      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$fetch_cart['product_id']]);
            $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
   ?>
<!--Form-->
   <form action="" method="POST" class="box">
      <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
      <img class="image" src="uploaded_img/<?= $fetch_product['image']; ?>" alt="">
      <h3 class="name"><?= $fetch_product['name']; ?></h3>
      <div class="flex">
         <span class="price">RM<?= $fetch_product['price']; ?></span>
         <input type="number" name="qty" class="qty" max="99" min="1" maxlength="2" required value="<?= $fetch_cart['qty']; ?>">
      </div>
      <p class="sub-total"><span>Sub total :RM</span> <?= $sub_total = ($fetch_cart['qty'] * $fetch_product['price']); ?></p>

   </form>
   <!--Calculate Total-->
   <?php
      $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">your cart is empty!</p>';
   }
   ?>
   
   </div>

</section>

<section>

   <form action="" class="count-container" method="POST">
      <p>Total : <span>RM<?= $grand_total; ?></span><br>Delivery:Rm 0</p>

   </form>

   <form action="" class="count-container" method="POST">
      <p><b>Customer Information:</b></p>
   </form>

   <form action="" class="count-container" method="POST">
      <p><b>Billing Address</b> 
      <br><?php echo $_POST["name"];?><br><?php echo $_POST["address"];?><br><?php echo $_POST["zip"];?><br><?php echo $_POST["city"];?><br><?php echo $_POST["state"];?></p>
   </form>

   <form action="" class="count-container" method="POST">
      <p><b>Shipping method</b> 
      <br>Free Shipping!</p>
   </form>

   <form action="" class="count-container" method="POST">
      <p><b>Payment Method</b> 
      <br>Card</p>
   </form>



   <div class="flex-btn" style="margin-top: 30px;">
      <a href="newmenu.php" class="inline-option-btn">continue shopping</a>

   </div>

</section>






<!-- Sweet alert cdn link  -->
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