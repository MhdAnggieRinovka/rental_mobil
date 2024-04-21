<?php
    require 'service/database.php';
    require 'fpdf/fpdf.php';
    session_start();
    if(isset($_SESSION['inv'])){
        $res = $_SESSION['inv'];
    }
    // print_r( $res['metode']);
    $metodeRental = $res['jenisRental'];
    $noPlat = $res['noMobil'];
    $ktp = $res['client'];
    $harga = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from datamobil where noKendaraan = '$noPlat'"));
    $dataClient = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from client where no_ktp = '$ktp'"));
    // print_r($dataClient);
    // print_r($harga[$metodeRental]);


    $pdf = new FPDF('P','mm','A4');

    $pdf->AddPage();
    
    $pdf->SetFont('Times','B','20');
    $pdf->Cell(71,10,'',0,0);
    $pdf->Cell(45,5,'Invoice',0,0,'C');
    $pdf->Cell(59,10,'',0,1);

    $pdf->SetFont('Arial','','13');
    $pdf->Cell(120,10,'PT.',0,0);
    $pdf->Cell(10,5,'',0,0);
    $pdf->Cell(30,10,'No :',0,1);
    
    $pdf->SetFont('Arial','','12');
    $pdf->Cell(120,5,'Jln.',0,0);
    $pdf->Cell(10,5,'',0,1);
    
    $pdf->Cell(172,10,'Tanggal : '. date('d-m-Y'),0,1,'R');
    
    $pdf->Cell(50,15,'',0,1);

    // Untuk Table
    $pdf->SetFont('Arial','B',10);

    $pdf->Cell(25,10,'Merek Mobil',1,0,'C');
    $pdf->Cell(30,10,'Metode Rental',1,0,'C');
    $pdf->Cell(35,10,'Lama Pemakaian',1,0,'C');
    $pdf->Cell(50,10,'Harga Sekali Peminjaman',1,0,'C');
    $pdf->Cell(50,10,'Total',1,1,'C');
    

    $pdf->SetFont('Arial','',9);
    $pdf->Cell(25,10,$res['mobil'],1,0,'C');
    $pdf->Cell(30,10,$res['jenisRental'],1,0,'C');
    $pdf->Cell(35,10,$res['waktu'],1,0,'C');
    $pdf->Cell(50,10,$harga[$metodeRental],1,0,'C');
    $pdf->Cell(50,10,$res['waktu']*$harga[$metodeRental],1,1,'C');

    $pdf->Cell(50,0,'',0,1);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(140,10,'SubTotal',0,0,'R');
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(50,10,$res['waktu']*$harga[$metodeRental],1,0,'C');


    $pdf->Cell(50,10,'',0,1);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(50,30,'Jenis Pembayaran : ' . $res['metode'],0,0);
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(50,30,'',0,1);
    
    $pdf->Cell(50,0,'Nama Client',0,2,'L');
    $pdf->SetFont('Arial','U',9);
    $pdf->Cell(60,60,'('.$dataClient['nama'].')',0,0,'L');
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(100,0,'PT.',0,2,'R');
    $pdf->SetFont('Arial','U',9);
    $pdf->Cell(110,60,'(Nama PT)',0,0,'R');

    $pdf->Output();
?>