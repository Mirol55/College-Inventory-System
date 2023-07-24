<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

//If User does not Login
if(!isset($admin_id)){
	header('location:login.php');
}


//Get Total Products

$rowcount_product=0;
$sql_product = "SELECT * FROM `products`";

if ($result1=mysqli_query($conn,$sql_product))
  {
  // Return the number of rows in result set
  $rowcount_product=mysqli_num_rows($result1);

  }



//Get Total Request
$rowcount_request=0;
$sql_request = "SELECT * FROM request WHERE request.Status = 'approve'";

if ($result2=mysqli_query($conn,$sql_request))
  {
  // Return the number of rows in result set
  $rowcount_request=mysqli_num_rows($result2);
  }

//Get Total Low Stock

//Get Total Request
$rowcount_stock=0;
$sql_stock = "SELECT * FROM products WHERE products.Stock <= 10";

if ($result3=mysqli_query($conn,$sql_stock))
  {
  // Return the number of rows in result set
  $rowcount_stock=mysqli_num_rows($result3);
  }

?>



<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scake=1">
    <title>KUPTM INVENTORY</title>

    <!--Css-->
    <link rel="stylesheet" type="text/css" href="css/admin.css">

    <!--Boxicons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?
    family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!--Favicons-->
   <link rel="icon" type="image/x-icon" href="/Inventory System/img/icon.png">

</head>

<body>

    <?php include 'sidebar.php' ?>

    <div class="container">

        <div class="content" style="padding-right:10%;">
            <div class="cards">

            <a href="admin_list.php"style="text-decoration:none!important;color:#a68b00;">
                <div class="card" style="background-color:#fff0c2;border:solid;">
                    <div class="box" >
                    
                        <h1><?php echo $rowcount_product ?></h1>
                        <h3>Products</h3>
                        <i class='bx bxs-shopping-bag-alt' style="font-size:60px;"></i>
                        
                    </div>
                </div>
            </a> 

            <a href="admin_status.php"style="text-decoration:none!important;color:#388e3c;">
                <div class="card" style="background-color:#c8e6c9;border:solid;">
                    <div class="box">
                        <h1><?php echo $rowcount_request ?></h1>
                        <h3>Request</h3>
                        <i class='bx bxs-basket' style="font-size:60px;"></i>
                    </div>
                </div>
            </a>

            <a href="admin_list.php"style="text-decoration:none!important;color:#c62828;">
                <div class="card" style="background-color:#ffcdd2;border:solid;">
                    <div class="box">
                        <h1><?php echo $rowcount_stock ?></h1>
                        <h3>Low Stock</h3>
                        <i class='bx bxs-error-circle' style="font-size:60px;"></i>
                    </div>
                </div>
            </div>
            </a>

            <div class="content-2">
                <div class="recent-payments">
                    <div class="title">
                        <h2>Generate Report</h2>
                    </div>
                    <form class="form-horizontal" action="getOrderReport.php" method="post" id="getOrderReportForm" target="_blank">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-2 control-label"  style="font-size:20px;padding-left:20px;padding-top:30px;">Start Date</label>
				    <div class="col-sm-10" style="padding-left:20px;">
				      <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" style="width:1000px;padding:20px 20px;"/>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-2 control-label" style="font-size:20px;padding-left:20px;padding-top:30px;" >End Date</label>
				    <div class="col-sm-10" style="padding-left:20px;">
				      <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date" style="width:1000px;padding:20px 20px;"/>
				    </div>
				  </div>
                  <div><input type="submit" value="Generate" class="button-30" name="generate" id="generateReportBtn" style="position: absolute;bottom:90px;left:1000px;color:green;"></div>
				</form>
                </div>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>



</body>
</html>