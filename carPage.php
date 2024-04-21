<?php
    include 'service/database.php';
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
        exit;
    }
    if (isset($_SESSION['username'])) {
            $user1 = $_SESSION['username'];
             $user = mysqli_query($conn,"SELECT * from useradmin where username = '$user1'");
             $namaUser = mysqli_fetch_assoc($user);
            //  var_dump($namaUser["nama"]);
    }
    $dataMobil = mysqli_fetch_all($conn->query("SELECT * from datamobil where status = 0"),MYSQLI_ASSOC);

    // $username = $_SESSION["username"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Car Page </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="./vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
  
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>


</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="./images/logo.png" alt="">
                <img class="logo-compact" src="./images/logo-text.png" alt="">
                <img class="brand-title" src="./images/logo-text.png" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <!-- <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div> -->
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./app-profile.html" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="./email-inbox.html" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a href="login.php" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <!-- <li class="nav-label first">Main Menu</li> -->
                    <!-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./index.html">Dashboard 1</a></li>
                            <li><a href="./index2.html">Dashboard 2</a></li>
                        </ul>
                    </li> -->
                    <!-- <li class="nav-label">Apps</li> -->
                    <li><a href="home.php">Data Client</a></li>
                    <li><a href="./app-profile.html">Data Car</a></li>
                </ul>
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back <?= $namaUser['nama'].' !'?></h4>
                        </div>
                    </div>
                </div>
                <?php
                    if(isset($_SESSION['AddData']))
                    {
                        echo "<script type='text/javascript'>alert('Add Car Data Successfully');</script>";
                        unset($_SESSION['AddData']);
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo "<script type='text/javascript'>alert('Delete Car Data Successfully');</script>";
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['edit']))
                    {
                        echo "<script type='text/javascript'>alert('Edit Car Data Successfully');</script>";
                        unset($_SESSION['edit']);
                    }
                ?>
                <!-- row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="functionCar/addCar.php" class="btn btn-primary">Add Data Mobil</a>
                            </div>
                            <div class="card-header">
                                <h4 class="card-title">Car Table</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-sm">
                                        <thead style="color: black;">
                                            <tr>
                                                <th>No</th>
                                                <th>Image</th>
                                                <th>Merek Kendaraan</th>
                                                <th>Warna Kendaraan</th>
                                                <th>Plat Kendaraan</th>
                                                <th>Tanggal Service</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color: black;">
                                            <?php $count = 1;?>
                                            <?php foreach ($dataMobil as $mobil): ?>
                                            <tr>
                                                <td><?= $count?></td>
                                                <td><img src="data:image/jpeg;base64,<?= $mobil['gambar']?>" alt="" style="height: 150px; width: 150px;"></td>
                                                <td><?= $mobil['merkMobil']?></td>
                                                <td><?= $mobil['warna']?></td>
                                                <td><?= $mobil['noKendaraan']?></td>
                                                <td><?= date("d-m-Y",strtotime($mobil['tgl_service']))?></td>
                                                <td><?php 
                                                    if($mobil['status']==0)
                                                    {
                                                        echo "Ready";
                                                    }
                                                ?></td>
                                                <td>
                                                    <a class="btn btn-success" href="rent/rentCar.php?id=<?= $mobil['noKendaraan']?>">Rent</a>
                                                    <a class="btn btn-warning" href="functionCar/editCar.php?id=<?= $mobil['noKendaraan']?>">Edit</a>
                                                    <a class="btn btn-danger" href="functionCar/removeCar.php?id=<?= $mobil['noKendaraan']?>">Delete</a>
                                                </td>
                                            </tr> 
                                            <?php
                                            $count++;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>


    <!-- Vectormap -->
    <script src="./vendor/raphael/raphael.min.js"></script>
    <script src="./vendor/morris/morris.min.js"></script>


    <script src="./vendor/circle-progress/circle-progress.min.js"></script>
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>

    <script src="./vendor/gaugeJS/dist/gauge.min.js"></script>

    <!--  flot-chart js -->
    <script src="./vendor/flot/jquery.flot.js"></script>
    <script src="./vendor/flot/jquery.flot.resize.js"></script>

    <!-- Owl Carousel -->
    <script src="./vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Counter Up -->
    <script src="./vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="./vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="./vendor/jquery.counterup/jquery.counterup.min.js"></script>


    <script src="./js/dashboard/dashboard-1.js"></script>

</body>

</html>