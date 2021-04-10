<?php 

	require 'php/function.php';
	require 'php/koneksi.php';
	
	session_start();

	if (!isset($_SESSION['login'])) {
		header('location: login.php');
	}

	$barang = query("SELECT * FROM tb_barang");


	if (isset($_POST['cari'])) {
			
			$barang = cari($_POST['keyword']);
		
	}


	
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Toko Online</title>

	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/konten.css">
	<link rel="stylesheet" type="text/css" href="css/index1.css">

</head>
<body>
	<div class="container">
	<div class="header">
		<nav class="navbar navbar-dark bg-dark p-2.5 fixed-top">
  			<a class="navbar-brand text-danger">Bukalapuk</a>
  			<form class="form-inline" method="POST">
	    		<input class="form-control mr-sm-2" type="search" placeholder="Cari Barang..." aria-label="Search" name="keyword">
	    		<button class="btn btn-outline-success my-2 my-sm-0" name="cari">Search</button>
	    		<button type="button" class="btn btn-outline-danger ml-2" onclick="return confirm('Yakin Ingin Logout?'),window.location.href = 'logout.php';">Logout</button>
  			</form>
		</nav>
	</div>	
	<div class="jarak"></div>
	<div class="slide">
		<img src="gambar/1.jpg" class="slide1">
		<img src="gambar/2.jpg" class="slide2">
		<img src="gambar/3.jpg" class="slide3">
	</div>

	<nav class="navbar navbar-dark bg-danger mt-4 p-3 px-5 rounded-lg">

	</nav>

	<div class="jualan row">

<?php 
	foreach($barang as $b) :

	$namaFile = $b['gambar'];

	
?>
				

		<div class="card mt-4 col-sm- bg-dark text-light ml-2" style="width: 17rem;">

			<?php if (empty($b['gambar'])): ?>
				<img src="gambar/default.png" class="card-img-top">
			<?php elseif (!file_exists("gambar/gambarProduk/$namaFile")) : ?>
				<img src="gambar/default.png" class="card-img-top">
				<?php else: ?>
					<img src="gambar/gambarProduk/<?= $b['gambar']; ?>" class="card-img-top" style=" max-height: 200px; min-height: 200px;">
			<?php endif; ?>
			

			<div class="card-body overflow-auto" style=" max-height: 500px;">
		    	<h5 class="card-title"><?= ucwords(kondisi($b['kondisi'],$b['nama'])); ?></h5>
		    	<p class="card-text"><?php read($b['deskripsi']); ?></p>
		    	<a href="?id=<?= $b['id']; ?>#beli" class="btn btn-success">Mulai Beli</a>
		    	<a href="ubah.php?id=<?= $b['id']; ?>" class="btn btn-primary">Ubah Barang</a>
		    	<a href="jual.php" class="btn btn-warning text-white mt-2">Tambah Barang</a>
		    	<a href="hapus.php?id=<?= $b['id']; ?>" onclick="return confirm('Yaking Ingin Dihapus?');" class="btn btn-danger mt-2">Hapus</a>
	  		</div>

	  			
	  			

		</div>

		<?php endforeach; 	  			

	  			if (isset($_GET['id'])) : 
	  				
	  				$id = $_GET['id'];
	  			
		  			$barang = query("SELECT * FROM tb_barang WHERE id='$id'")[0];
		  			$gambar = $barang["gambar"];?>
	  				
	  				<div class="beli" id="beli">
	  					<div class="card mx-auto" style="max-width: 90%;">

						  <div class="row no-gutters">
						    <div class="col-md-4">
						      <img src="gambar/gambarProduk/<?= $gambar; ?>" class="card-img" alt="...">
						    </div>
						    <div class="col-md-8">
						      <div class="card-body">
						        <h5 class="card-title text-danger"><?= ucwords(kondisi($barang['kondisi'],$barang['nama'])); ?></h5>
						        <p class="card-text">Deskripsi : <br><?= ucwords($barang['deskripsi']) ?></p>
						        <p class="card-text"><warna>Stock :</warna> <?= ucwords($barang['stok']) ?><br> <warna>Tempat :</warna> <?= ucwords($barang['kota']) ?></p>
						        <p class="card-text "><small class="text-muted">Harga : Rp.<?= $barang['harga']; ?>,00</small></p>
						        <a href="?id=<?= $b['id']; ?>#beli" class="btn btn-success px-4">Beli</a>
						        <a href="index.php" class="btn btn-primary px-4">Kembali</a>
						      </div>
						    </div>
						  </div>
						</div>
	  				</div>

	  			<?php endif; ?>

	</div>

	<div class="footer">
		
	</div>

</body>
</html>