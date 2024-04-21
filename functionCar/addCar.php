<?php
    include '../service/database.php';
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("Location: ../login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Data Mobil </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon.png">
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
                                    <form action="addCar.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label><strong>No Plat Mobil</strong></label>
                                            <input type="text" name="noKendaraan" class="form-control" placeholder="No Kendaraan" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Merk Mobil</strong></label>
                                            <input type="text" class="form-control" placeholder="Masukkan Merk Mobil" name="merkMobil" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Warna</strong></label>
                                            <input type="text" class="form-control" name="warna" placeholder="Masukkan Warna Mobil" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Harga Sewa</strong></label>
                                            <input type="text" class="form-control" name="harga" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Input Gambar</strong></label>
                                            <input type="file" class="form-control" name="gambar" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Tanggal Service</strong></label>
                                            <input type="date" class="form-control" name="tgl_service" required>
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" name="add" class="btn btn-primary btn-block">Add Data</button>
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

<?php
    if(isset($_POST['add']))
    {
        $noKendaraan = htmlspecialchars($_POST['noKendaraan']);
        $merkMobil = htmlspecialchars($_POST['merkMobil']);
        $warna = htmlspecialchars($_POST['warna']);
        $harga = htmlspecialchars($_POST['harga']);
        // $gambar = htmlspecialchars($_POST['gambar']);
        $gambar = ($_FILES['gambar']['tmp_name']);
        $imgbinary = fread(fopen($gambar, "r"), filesize($gambar));
        $img_str = base64_encode($imgbinary);

        $tgl_service = $_POST['tgl_service'];
        $status = 0;
        // echo $tglLahir;
        $query = mysqli_query($conn,"INSERT INTO datamobil
            VALUES ('$noKendaraan','$merkMobil','$warna','$harga','$status','$img_str','$tgl_service')
        ");
        if(mysqli_affected_rows($conn)>0)
        {
            $_SESSION['AddData'] = true;
            header("Location: ../carPage.php");
            exit;
        }
        else
        {
            var_dump(mysqli_error($conn));
            die;
        }
    }
?>