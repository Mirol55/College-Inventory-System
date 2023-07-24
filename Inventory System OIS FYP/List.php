<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

//If User does not Login
if(!isset($user_id)){
	header('location:login.php');
}

//If User Add product to cart
if(isset($_POST['add'])){

   $product_name = $_POST['product_name'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $product_id=$_POST['product_id'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE P_Name = '$product_name' AND ID = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $warning_message[] = 'Item Already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(ID, P_Name,Quantity,Image,ID_P) VALUES('$user_id', '$product_name','$product_quantity', '$product_image', '$product_id')") or die('query failed');
      $success_message[] = 'Added to cart!';
   }

}

// Get search input
if(isset($_GET['search'])) {
   $filtervalues = $_GET['search'];
} else {
   $filtervalues = "";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/list.css">

   <!-- custom js file link  -->
   <script src="js/list.js" defer></script>

   <!--Boxicons-->
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


   <!--SweetAlert-->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

   <link rel="icon" type="image/x-icon" href="/Inventory System/img/icon.png">
   <title>Products List</title>

</head>
<body>
   <!-- Header -->  
<?php

      include 'header.php';
      include 'message.php';
 
?>
   <!-- Product Image and name  -->



<div class="container">

   <h3 class="title"> Office Equipment </h3>
   <h4 class="title"><?php if(isset($_GET['search'])){echo 'Result for: "'.$_GET['search'].'"';}?></h4>

   <div class="products-container">

   <!-- Loop  -->

   <?php  
         $query = mysqli_query($conn, "SELECT * FROM `products` WHERE CONCAT (`P_Name`) LIKE '%$filtervalues%'") or die('query failed');
         if(mysqli_num_rows($query) > 0){
            while($products = mysqli_fetch_assoc($query)){
   ?>
   <form action="" method="post" class="box">
      <div class="product" data-name="p-1" style="min-height:424px">
      <img src="items/<?php echo $products['Image']; ?>" alt="">
         <h3><?php echo $products['P_Name']; ?></h3>
         <div class="price"><i class='bx bxs-circle' style="color:<?php echo $products['Stock'] <= 0 ? 'red' : 'green'; ?>;"></i>Stock:<?php echo $products['Stock']; ?></div>
         <input type="hidden" name="product_name" value="<?php echo $products['P_Name']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $products['Image']; ?>">
         <input type="hidden" name="product_id" value="<?php echo $products['ID_P']; ?>">
         <?php if($products['Stock'] > 0){

         echo '
         <input type="number" name="product_quantity" min="1" max="5" value="1" style="   font-size: 16px;
         padding: 10px;
         border: 2px solid #ccc;
         border-radius: 4px;
         width: 100px;
         box-sizing: border-box;
         margin-bottom: 10px;"><br><br>

         <div class="col-xs-12">
         <input type="submit" class="submit-btn" name="add" value="Request">
         </div>';

         
            
         } ?>
    
      </div>
   </form>

   <?php }  ?><!--End Loop  -->  

   </div>

   

</div>

<!--Loop  -->  
<?php

      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
?>


</body>
</html>