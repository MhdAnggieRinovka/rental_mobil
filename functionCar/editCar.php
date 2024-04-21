<?php
 include '../service/database.php';
 session_start();
 if(!isset($_SESSION['login']))
 {
     header("Location: ../login.php");
     exit;
 }
 $noKendaraan = $_GET['id'];
 $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from datamobil where noKendaraan = '$noKendaraan'"));
//  var_dump($query);
//  die;
if(isset($_GET['id']))
{
    if(isset($_POST['edit']))
    {
        $noKendaraan = $_POST['noKendaraan'];
        $merk = htmlspecialchars($_POST['merk']);
        $warna = htmlspecialchars($_POST['warna']);
        $perhari = htmlspecialchars($_POST['perhari']);
        $perbulan = htmlspecialchars($_POST['perbulan']);
        $pertahun = htmlspecialchars($_POST['pertahun']);

        $gambar = ($_FILES['gambar']['tmp_name']);
        $imgbinary = fread(fopen($gambar, "r"), filesize($gambar));
        $img_str = base64_encode($imgbinary);

        $tgl_service = $_POST['tgl_service'];
        // $hargaSewa = htmlspecialchars($_POST['hargaSewa']);

        // var_dump($_POST);
        // die;

        $data = mysqli_query($conn,"UPDATE datamobil set merkMobil='$merk', warna='$warna', perhari='$perhari', perbulan='$perbulan', pertahun='$pertahun', gambar='$img_str', tgl_service='$tgl_service' where noKendaraan = '$noKendaraan'");
        // var_dump($_GET['id']);
        // die;
        if (mysqli_affected_rows($conn)>0) {
            $_SESSION['edit'] = true;
            header("Location: ../carPage.php");
            exit;
        }
        else
        {
            // echo "alert(".mysqli_error($conn).")";
            mysqli_error($conn);
            // die;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edit Data Mobil</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="../fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div style="color: black;">
                                        <i class="zmdi zmdi-arrow-left"></i>
                                        <a href="../carPage.php" style="color: black; text-decoration: none;">Back</a>
                                    </div>
                                    <h4 class="text-center mb-4">Edit Data Mobil</h4>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <!-- <div class="form-group"> -->
                                            <!-- <label><strong>No KTP</strong></label> -->
                                            <input type="text" name="noKendaraan" class="form-control" placeholder="No KTP" minlength="16" maxlength="16" value="<?= $query['noKendaraan']?>" hidden readonly required>
                                        <!-- </div> -->
                                        <div class="form-group">
                                            <label><strong>Merk Kendaraan</strong></label>
                                            <input type="text" class="form-control" placeholder="Enter Your Name" name="merk" value="<?= $query['merkMobil']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Warna Kendaraan</strong></label>
                                            <input type="text" class="form-control" name="warna" value="<?= $query['warna']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Harga Per Hari</strong></label>
                                            <input type="number" class="form-control" min="0" name="perhari" value="<?= $query['perhari']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Harga Per Bulan</strong></label>
                                            <input type="number" class="form-control" min="0" name="perbulan" value="<?= $query['perbulan']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Harga Per Tahun</strong></label>
                                            <input type="text" class="form-control" name="pertahun" min="0" value="<?= $query['pertahun']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Gambar</strong></label>
                                            <input type="file" class="form-control" name="gambar" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Tanggal Service</strong></label>
                                            <input type="date" class="form-control" name="tgl_service" required>
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" name="edit" class="btn btn-primary btn-block">Edit Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="../vendor/global/global.min.js"></script>
    <script src="../js/quixnav-init.js"></script>
    <!--endRemoveIf(production)-->
</body>

</html>

