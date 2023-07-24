<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];




//Add product
if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_stock = $_POST['product_stock'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'items/'.$product_image;

   if(empty($product_name) || empty($product_stock) || empty($product_image)){
      $warning_message[] = 'Please Fill Out All Details';
   }else{
      $insert = "INSERT INTO products(P_Name,Stock,Image) VALUES('$product_name', '$product_stock', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $success_message[] = 'Product Added!';
      }else{
         $success_message[] = 'Product Added!';
      }
   }

};

//Delete product
if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE ID_P = '$id'");
   $success_message[] = 'Product Deleted!';
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin List</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_list.css">

   <!--Favicons-->
   <link rel="icon" type="image/x-icon" href="/Inventory System/img/icon.png">

   <!--SweetAlert-->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</head>
<body>
<?php include 'sidebar.php';
      include 'message.php'; ?>
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
<h3 style="   font-size: 4.5rem; color:#444;margin-bottom: 3rem;text-transform: uppercase;text-align: center;padding-top:120px;">Products</h3>
<div class="container" style="padding-left:70px;">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="Enter product name" name="product_name" class="box">
         <input type="number" placeholder="Enter equipment stock" name="product_stock" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="button-30" name="add_product" value="add product" style="width:150px;text-align:center;">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM products");
   
   ?>
   
</section>

<!--Display products-->
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Equipment Image</th>
            <th>Equipment Name</th>
            <th>Equipment Stock</th>
            <th>Action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="items/<?php echo $row['Image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['P_Name']; ?></td>
            <td><?php echo $row['Stock']; ?></td>
            <td>
               <a href="admin_update.php?edit=<?php echo $row['ID_P']; ?>" class="button-30" style="width:90px;color:green;"> <i class="fas fa-edit"></i> edit </a>
               <a href="admin_list.php?delete=<?php echo $row['ID_P']; ?>" class="button-30" style="width:90px;color:red;"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>