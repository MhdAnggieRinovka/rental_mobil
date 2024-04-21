<?php
	include '../service/database.php';
	session_start();
	if(!isset($_SESSION['login']))
    {
        header("Location: ../login.php");
        exit;
    }
	$data = $_GET['id'];
	$query = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from datamobil where noKendaraan = '$data'"));
	$client = mysqli_fetch_all($conn->query("SELECT * from client"),MYSQLI_ASSOC);

	// var_dump($client);
	// die;
	
	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>RegistrationForm_v1 by Colorlib</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="../fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="../css/styleForm.css">
	</head>

	<body>

		<div class="wrapper" style="background-image: url('../images/bg-registration-form-1.jpg');">
			<div class="inner">
				<div class="image-holder">
					<img src="data:image/jpeg;base64,<?= $query['gambar']?>" style="height: 500px; width: 500px;" alt="">
				</div>
				<form action="rentCar.php" method="post">
					<div style="position: static; color: black;">
						<i class="zmdi zmdi-arrow-left"></i>
						<a href="../carPage.php" style="color: inherit; text-decoration: none;">Back</a>
					</div>
					<h3>Rental Car</h3>
					<div class="form-wrapper">
						<?php
							echo '<select name="ktp" id="ktp" class="form-control" required>';
								foreach($client as $data)
								{
									echo '<option value="" disabled selected>Nama</option>';
									echo '<option value="'.$data['no_ktp'].'">'.$data['nama']." ".$data['no_ktp'].'</option>';
								}
							echo '</select>';
						?>
					</div>
					<div class="form-wrapper">
						<input type="text" name="noMobil" value="<?= $query['noKendaraan']?>" hidden>
						<input type="text" name="mobil" value="<?= $query['merkMobil']?>" hidden>
						<i class="zmdi zmdi-calender"></i>
						<select name="jenisRental" class="form-control" required>
							<option value="" disabled selected>Metode Rental</option>
							<option value="perhari">Per Hari</option>
							<option value="perbulan">Per Bulan</option>
							<option value="pertahun">Per Tahun</option>
						</select>
					</div>
					<div class="form-wrapper">
						<i class="zmdi zmdi-money"></i>
						<select name="pembayaran" class="form-control" id="pembayaran" onchange="displayPay()" required>
							<option value="">Metode Pembayaran</option>
							<option value="ebanking">E Banking</option>
							<option value="transfer">Transfer</option>
							<option value="tunai">Tunai</option>
						</select>
					</div>
					<div class="form-wrapper" id="show" style="display: none;">
						<i class="zmdi zmdi-money"></i>
						<input type="text" name="bayar" id="bayar" placeholder="Total Biaya" class="form-control">
					</div>
					<div class="form-wrapper">
						<i class="zmdi zmdi-alarm"></i>
						<input type="number" name="waktu" placeholder="Berapa Lama Pemakaian" min="1" class="form-control" required>
					</div>
					<button type="submit" name="rental">Rent Now <i class="zmdi zmdi-arrow-right"></i>
					</button>
				</form>
			</div>
		</div>
		
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>

<?php
	if(isset($_POST['rental']))
	{
		if(isset($_POST['bayar']))
		{
			$bayar = htmlspecialchars($_POST['bayar']);
			$client = $_POST['ktp'];
			$noMobil = $_POST['noMobil'];
			$mobil = $_POST['mobil'];
			$jenisRental = $_POST['jenisRental'];
			$metode = $_POST['pembayaran'];
			$waktu = $_POST['waktu'];
			$arr = array(
				'client' => $client,
				'noMobil' => $noMobil,
				'mobil' => $mobil,
				'jenisRental' => $jenisRental,
				'metode' => $metode,
				'bayar' => $bayar,
				'waktu' => $waktu
			);
			$_SESSION['inv'] = $arr;
		}
		else
		{
			$client = $_POST['ktp'];
			$noMobil = $_POST['noMobil'];
			$mobil = $_POST['mobil'];
			$jenisRental = $_POST['jenisRental'];
			$metode = $_POST['pembayaran'];
			$waktu = $_POST['waktu'];
			$arr = array(
				'client' => $client,
				'noMobil' => $noMobil,
				'mobil' => $mobil,
				'jenisRental' => $jenisRental,
				'metode' => $metode,
				'waktu' => $waktu
			);
			$_SESSION['inv'] = $arr;
		}
		header("Location: ../pdf.php");
		exit;
	}
?>

<script	src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script	src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
	function displayPay()
	{
		var bayar = $("#pembayaran").val();
		if(bayar==="tunai")
		{
			document.getElementById("show").style.display='block';
		}
		else
		{
			document.getElementById("show").style.display='none';
		}
	}
</script>