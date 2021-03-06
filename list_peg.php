<?php 
//koneksi ke function
require 'function.php';


//pagination
//konfigurasi
$jmlhDataPerHalaman = 10;
$jumlahData = count(query("SELECT * FROM pegawai"));
$jumlahHalaman = ceil($jumlahData / $jmlhDataPerHalaman);
 
$halamanAktif = ( isset($_GET["halaman"]) ) ?  $_GET["halaman"] : 1;
$awalData = ( $jmlhDataPerHalaman * $halamanAktif ) - $jmlhDataPerHalaman;
$halListPegUri = explode('&', $_SERVER['REQUEST_URI'], 2)[0];
$pegawai = query("SELECT * FROM pegawai LIMIT $awalData,$jmlhDataPerHalaman");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>List Pegawai</title>

	<style type="text/css">
        table>tbody>tr>td {
    		border-style: inset;
    		font-size: 15px;
			font-style: italic;
			font-variant: small-caps;
			padding: 5px 50px;
		}
    </style>

</head>
<body>
	
	<a href="<?php echo $_SERVER['REQUEST_URI'] ?>&hal=tambah"> Tambah </a>

	<h3>Data Pegawai</h3>
<br><br>

<!-- navigasi -->
<?php for ($i=1; $i <= $jumlahHalaman ; $i++) : ?>
	<!-- <a href="?halaman=<?= $i; ?>"><?= $i; ?></a> -->
	<!-- <a href="<?php echo $_SERVER['REQUEST_URI'] ?>&halaman=<?= $i; ?>"><?= $i; ?></a> -->
	<a href="<?php echo $halListPegUri ?>&halaman=<?= $i; ?>"><?= $i; ?></a>
<?php endfor; ?>

<table border="2" cellpadding="10" cellspacing="0" style="border-color:  white;">
	<tr style="text-align: center;">
		<td>
			<strong>NIP</strong>
		</td>
		<td>
			<strong>Nama</strong>
		</td>
		<td>
			<strong>Jabatan</strong>
		</td>
		<td>
			<strong>Aksi</strong>
		</td>
	</tr>
	
	<?php foreach( $pegawai as $row ) : ?>
	<tr>
		<td style="text-align: center;"><?= $row["nip"]; ?></td>
		<td><?= $row["nama"]; ?></td>
		<td><?= $row["status"]; ?></td>
		<td>
			<a href='cetak.php?nip=<?= $row["nip"]; ?>'>cetak</a> |
			<a href='ubah.php?nip=<?= $row["nip"]; ?>'>ubah</a> |
			<a href='hapus.php?nip=<?= $row["nip"]; ?>'>hapus</a>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
</body>
</html>