<?php 
session_start();

$admin_id = $_SESSION['admin_id'];

//If User does not Login
if(!isset($admin_id)){
	header('location:login.php');
}

$con = mysqli_connect("localhost","root","","inventory_system");

// Get search input
if(isset($_GET['search'])) {
    $filtervalues = $_GET['search'];
} else {
    $filtervalues = "";
}

// Fetch data from database
$query = "SELECT * FROM `contact` WHERE CONCAT(`Name`)  LIKE '%$filtervalues%' ";
$query_run = mysqli_query($con, $query);

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    
    <!--Favicons-->
    <link rel="icon" type="image/x-icon" href="/Inventory System/img/icon.png">
    
</head>
<body>
    <?php include 'sidebar.php' ?>
    <h3 style="   font-size: 4.5rem; color:#444;margin-bottom: 3rem;text-transform: uppercase;text-align: center;padding-top:120px;">Messages</h3>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Messages</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search"  value="<?php echo $filtervalues; ?>" class="form-control" placeholder="Search data">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Number</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $items)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $items['ID']; ?></td>
                                                <td><?= $items['Name']; ?></td>
                                                <td><?= $items['Email']; ?></td>
                                                <td><?= $items['P_Num']; ?></td>
                                                <td><?= $items['Msg']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <tr>
                                                <td colspan="5">No Record Found</td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>