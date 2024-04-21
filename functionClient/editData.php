<?php
 include '../service/database.php';
 session_start();
 if(!isset($_SESSION['login']))
 {
     header("Location: ../login.php");
     exit;
 }
 $ktp = $_GET['no_ktp'];
 $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from client where no_ktp = '$ktp'"));
//  var_dump($query);
//  die;
if(isset($_GET['no_ktp']))
{
    if(isset($_POST['edit']))
    {
        $noKTP = $_POST['no_ktp'];
        $nama = htmlspecialchars($_POST['nama']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $tglLahir = htmlspecialchars($_POST['date']);
        $telpon = htmlspecialchars($_POST['tel']);
        $fb = htmlspecialchars($_POST['fb']);
        $ig = htmlspecialchars($_POST['ig']);
        $tt = htmlspecialchars($_POST['tt']);

        // var_dump($_POST);
        // die;

        $data = mysqli_query($conn,"UPDATE client set nama='$nama', alamat='$alamat',tgl_lahir='$tglLahir', phone_number='$telpon', facebook='$fb', instagram='$ig', tiktok='$tt' where no_ktp = '$noKTP'");
        // var_dump($_GET['id']);
        // die;
        if (mysqli_affected_rows($conn)>0) {
            $_SESSION['edit'] = true;
            header("Location: ../home.php");
            exit;
        }
        else
        {
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
    <title>Edit Data </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
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
                                    <h4 class="text-center mb-4">Edit Data Client</h4>
                                    <form action="" method="POST">
                                        <!-- <div class="form-group"> -->
                                            <!-- <label><strong>No KTP</strong></label> -->
                                            <input type="text" name="no_ktp" class="form-control" placeholder="No KTP" minlength="16" maxlength="16" value="<?= $query['no_ktp']?>" hidden readonly required>
                                        <!-- </div> -->
                                        <div class="form-group">
                                            <label><strong>Nama</strong></label>
                                            <input type="text" class="form-control" placeholder="Enter Your Name" name="nama" value="<?= $query['nama']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Alamat</strong></label>
                                            <input type="text" class="form-control" name="alamat" value="<?= $query['alamat']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Tanggal Lahir</strong></label>
                                            <input type="date" class="form-control" name="date" value="<?= $query['tgl_lahir']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>No Telphone</strong></label>
                                            <input type="tel" class="form-control" name="tel" maxlength="12" value="<?= $query['phone_number']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Facebook</strong></label>
                                            <input type="text" class="form-control" name="fb" >
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Instagram</strong></label>
                                            <input type="text" class="form-control" name="ig" >
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Tiktok</strong></label>
                                            <input type="text" class="form-control" name="tt">
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

