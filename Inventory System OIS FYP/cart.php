<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

//If User does not Login
if(!isset($user_id)){
	header('location:login.php');
}

//Delete item from cart
if(isset($_GET['delete'])){
	print 'delete';
	$id = $_GET['delete'];
	mysqli_query($conn, "DELETE FROM cart WHERE C_ID =" . $id);
	
}

//Delete all item from cart
if(isset($_POST['delete_all'])){


	mysqli_query($conn, "DELETE FROM cart WHERE ID =" . $user_id.";");

}

//Cart
if(isset($_POST['request_submit'])){



	//Pass Data Into Variable
	$name =$_SESSION['user_name'];
	$email =$_SESSION['user_email'];
	$date = date('Y-m-d');
	$status = 'pending';
 
 	//Initialize variable
	$cart_total = 0;

	//Declare Array
	$cart_products[] = '';



	//Select Row from cart table where ID = user_id
	$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE ID = '$user_id'") or die('query failed');


	//Update quantity
	$select_cart_while = mysqli_query($conn, "SELECT * FROM `cart` WHERE ID = '$user_id'"); //prepare statement for looping cart item owned by user
	// loop through cart tables
	while($row = mysqli_fetch_array($select_cart_while)) {
		//get cart item id
		$c_id = $row['C_ID'];

		//get the input field 'product_quantity$c_id'
		$qty = $_POST["product_quantity".$row['C_ID']];

		//if input quantity entered by user is more than 0, consider valid
		if($qty > 0){
			//valid; proceed
			// update the quantity in the database entry for cart item

			
			mysqli_query($conn,"UPDATE cart SET Quantity =" . $qty . " WHERE C_ID=".$c_id.";"); //redundant
		
			//retrieve the cart item product from 'products' table
			$prod_query = mysqli_query($conn, 'SELECT * FROM products WHERE ID_P='.$row['ID_P']);
			$prod = mysqli_fetch_array($prod_query);


			//subtract available Stock in products table by the quantity requested by user
			mysqli_query($conn,"UPDATE products SET Stock =" . ($prod['Stock'] - $qty) . " WHERE ID_P=".$row['ID_P']);

		} else {
			//user entered amount less than 1, invalid
			print("Please enter a quantity more than 0.");
		}
	}
	
	//If there is at least 1 row
	if(mysqli_num_rows($select_cart) > 0){
		//$cart_products = "";
		//Loop
	   	while($cart_item = mysqli_fetch_assoc($select_cart)){
		$cart_total +=1;  

		//$cart_products = $cart_products . $cart_item['P_NAME']." (";
		$cart_products[] = $cart_item['P_Name'].' ('. $_POST["product_quantity".$cart_item['C_ID']].') ';

	   }
	
	}

 
	//Insert products into request table
	$total_request = implode(', ',$cart_products);

	$select_request = mysqli_query($conn, "SELECT * FROM `request` WHERE Name = '$name' AND Email = '$email' AND Request = '$total_request'") or die('query failed');

	//var_dump($select_request);
	if($cart_total < 1){
		$error_message[] = 'Your card is empty!';

	}
	else{
	  
		  mysqli_query($conn, "INSERT INTO `request`(ID, Name, Email, Request, Status,Authorizer,Date_Field) VALUES('$user_id', '$name','$email','$total_request','$status','None','$date')") or die('query failed');
		  $success_message[] = 'order placed successfully!';
		  mysqli_query($conn, "DELETE FROM `cart` WHERE ID = '$user_id'") or die('query failed');
	

	}

	
 	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css">
    <link href="css/cart.css" rel="stylesheet">

    <!--Favicons-->
    <link rel="icon" type="image/x-icon" href="/Inventory System/img/icon.png">

    <!--SweetAlert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body>
    <?php   include 'header.php';
      		include 'message.php'; 
			
	?>

    <div class="wrapper" style="padding-top:90px;">
        <form action="" method="POST">
            <h1 class="title">Cart</h1>
            <div class="project">

                <div class="shop">
                    <!--Start Loop-->
                    <?php
         	$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE ID = '$user_id'") or die('query failed');
         	if(mysqli_num_rows($select_cart) > 0){
            while($cart = mysqli_fetch_assoc($select_cart)){   
       		 ?>
                    <div class="boxo">
                        <img src="items/<?php echo $cart['Image']; ?>" alt="">
                        <div class="content">
                            <h3 style="font-size:20px;"><?php echo $cart['P_Name']; ?></h3>
                            <input type="number" min="1" max="5" name="<?php echo "product_quantity".$cart['C_ID']; ?>"
                                value=<?php echo $cart['Quantity']; ?> class="unit" style="   font-size: 16px;
									padding: 10px;
									border: 2px solid #ccc;
									border-radius: 4px;
									width: 100px;
									box-sizing: border-box;
									margin-bottom: 10px;">

                            <button class="button-30" name="Delete"
                                style="position: absolute;bottom: 20px;right: 20px;color:red;"
                                onclick="location.href='<?php echo strtok($_SERVER["REQUEST_URI"], '?') . '?delete='.$cart['C_ID']; ?>';">Delete</button>
                        </div>
                    </div>
                    <?php
            }
            }else{
          	 echo '<h1 class="empty" style="text-align: center; line-height: calc(70vh - 200px);">Your cart is empty</h1>';
            }
            ?>
                    <!--End Loop-->
                </div>


                <div class="right-bar">
                    <p><span>Name:</span> <span><?php echo $_SESSION['user_name']; ?></span></p>
                    <hr>
                    <p><span>Email:</span> <span><?php echo $_SESSION['user_email']; ?></span></p>
                    <hr>
                    <p><span>Date:</span> <span><?php echo date('d-M-Y');?></span></p>
                    <hr>

                    <input type="hidden" value="1" id="request" name="request">
                    <button class="button-30" name="delete_all"
                                style="width:100px;color:red;"
                                onclick="location.href='<?php echo strtok($_SERVER["REQUEST_URI"], '?') . '?delete_all'; ?>';"> Delete All</button>
                    <input type="submit" value="Request" class="button-30" name="request_submit" style="color:green;">

                </div>
            </div>
        </form>
    </div>
</body>

</html>