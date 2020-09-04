<!DOCTYPE html>
<html>
<head>
	<title>Cetak</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<style>
		 table {
            width: 90%;
            margin-left: 5%;
            margin-right: 5%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        table th {
            text-align: center;
        }

        table td {
            text-align: justify;
            word-wrap: break-word;
        }
	</style>
</head>
<body  style="font-family: sans-serif;font-size: 14px color: #000;">
	<div class="container">
		<?php include '../../connections/connection_db.php';  include '../../connections/tgl_indo.php';
		date_default_timezone_set('Asia/Jakarta'); ?>
		<header>
			<div class="row" style="margin-top: 2%">
				<div class="col-md-2">
					<img src="../../assets/images/bjm.png" alt="" style="text-align: center; width: 95px; height: 150px;">
				</div>
				<div class="col-sm-8">
					<center>
						<strong><h2>PEMERINTAH KOTA BANJARMASIN</h2><h3>BAGIAN PEMERINTAHAN SEKRETARIAT DAERAH KOTA BANJARMASIN</h3></strong>Jl. RE Martadinata No. 01 Banjarmasin 70111, Blok : D lantai III<br>E-Mail : <a href="#">bag_tapem_bjm@yahoo.com</a>, Telpon/Fax : 0812345678
					</center>
				</div>
			</div>
		</header>
		<center><u><hr class="border border-dark"></u></center>
		<br>

		




