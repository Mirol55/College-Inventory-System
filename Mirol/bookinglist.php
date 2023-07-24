<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Mirol Cafe</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <style>

    a{
        text-decoration: none; 
    }

    </style>


</head>
<body>
    <!--Header Section-->
<header>

<a href="#" class="logo">Mirol's<span>  Cafe Admin</span></a>


<ul class="navbar">
    <li><a href="admin_home.html">Home</a></li>
    <li><a href="bookinglist.php">Booking</a></li>
    <li><a href="admin_page.php">Menu</a></li>


</ul>
</div>

<div class="h-icons">
    <a href="#"><i class='bx bx-search'></i></a>
    <a href="cart.php"><i class='bx bxs-cart'></i></a>
    <a href="newlogin.php"><i class='bx bxs-user'></i></a>
    <div class="bx bx-menu" id="menu-icon"></div>

</div>

</header>

<br><br><br><br><br><br>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Booking List </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                            
                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Pax</th>
                                    <th>Time</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $con = mysqli_connect("localhost","root","","mirol_cafe");

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT * FROM `book` WHERE CONCAT(`ID_C`, `Name`, `Address`, `Date`, `Pax`, `Time`, `Note`)  LIKE '%$filtervalues%' ";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $items['ID_C']; ?></td>
                                                    <td><?= $items['Name']; ?></td>
                                                    <td><?= $items['Address']; ?></td>
                                                    <td><?= $items['Date']; ?></td>
                                                    <td><?= $items['Pax']; ?></td>
                                                    <td><?= $items['Time']; ?></td>
                                                    <td><?= $items['Note']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="4">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
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