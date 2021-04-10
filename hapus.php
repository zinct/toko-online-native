<?php 

	require 'php/koneksi.php';
	require 'php/function.php';

	session_start();

	if (!isset($_SESSION['login'])) {
		header('location: login.php');
	}


	$id = $_GET['id'];

	if (hapus($id) > 0) {
		echo "<script>
					alert('Berhasil Menghapus Barang');
					window.location.href = 'index.php'
				  </script>
				  ";
	}

	else {
		mysqli_error($conn);
	}

 ?>