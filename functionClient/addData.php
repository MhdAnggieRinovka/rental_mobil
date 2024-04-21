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
    <title>Add Data Client </title>
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
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    <form action="addData.php" method="POST">
                                        <div class="form-group">
                                            <label><strong>No KTP</strong></label>
                                            <input type="text" name="no_ktp" class="form-control" placeholder="No KTP" minlength="16" maxlength="16" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Nama</strong></label>
                                            <input type="text" class="form-control" placeholder="Masukkan Nama" name="nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Alamat</strong></label>
                                            <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Tanggal Lahir</strong></label>
                                            <input type="date" class="form-control" name="date" pattern="\d{4}-\d{2}-\d{2}" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>No Telphone</strong></label>
                                            <input type="tel" class="form-control" name="tel" placeholder="Masukkan No Telephone" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Facebook</strong></label>
                                            <input type="text" class="form-control" name="facebook" placeholder="Masukkan user facebook anda">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Instagram</strong></label>
                                            <input type="text" class="form-control" name="ig" placeholder="Masukkan user instagram anda">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Tiktok</strong></label>
                                            <input type="text" class="form-control" name="tiktok" placeholder="Masukkan user tiktok anda">
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" name="register" class="btn btn-primary btn-block">Sign me up</button>
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
    if(isset($_POST['register']))
    {
        $noKTP = htmlspecialchars($_POST['no_ktp']);
        $nama = htmlspecialchars($_POST['nama']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $tglLahir = htmlspecialchars($_POST['date']);
        $telpon = htmlspecialchars($_POST['tel']);
        $facebook = htmlspecialchars($_POST['facebook']);
        $instagram = htmlspecialchars($_POST['ig']);
        $tiktok = htmlspecialchars($_POST['tiktok']);
        // echo $tglLahir;
        $query = mysqli_query($conn,"INSERT INTO client
            VALUES ('$noKTP','$nama','$alamat','$tglLahir','$telpon','$facebook','$instagram','$tiktok')
        ");
        if(mysqli_affected_rows($conn)>0)
        {
            $_SESSION['AddData'] = true;
            header("Location: ../home.php");
            exit;
        }
        else
        {
            var_dump(mysqli_error($conn));
            die;
        }
    }
?>