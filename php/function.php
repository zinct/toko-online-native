<?php 

	function register($data) {
		global $conn;

		$username = htmlspecialchars(mysqli_escape_string($conn, $data['username']));
		$password = htmlspecialchars(mysqli_escape_string($conn, $data['password']));
		$password2 = htmlspecialchars(mysqli_escape_string($conn, $data['password2']));

		$pass = strlen($password);

		//cek Username
		$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

		if (!preg_match("/^[a-zA-Z0-9999999]*$/", $username)) {
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Gagal Membuat Akun!</strong> 
					  Dilarang Menggunakan Spasi Atau Simbol Pada Username.
					</div>';
			return 0;
		}


		if (mysqli_num_rows($result) > 0) {
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Gagal Membuat Akun!</strong> 
					  Username Sudah Terpakai.
					</div>';
			return 0;
		}	

			if ($pass < 8) {
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Gagal Membuat Akun!</strong> 
						Password Minimal 8 Karakter.
					   </button>
					</div>';
			return 0;
			}

			if ($password !== $password2) {
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Gagal Membuat Akun!</strong> 
					  Password Tidak Sama.
					</div>';
			return 0;
			}

			//enkripsi Password hrus pake php 7, tpi di lab cuma pke php versi 5
			//Matiin Aja Enkripsinya
			
			// $password = password_hash($password, PASSWORD_DEFAULT);

			mysqli_query($conn,"INSERT INTO tb_user VALUES ('','$username', '$password')");

			return 1;

		
	}

	function login($data) {

		global $conn;

		$username = htmlspecialchars(mysqli_escape_string($conn, $data['username']));
		$password = htmlspecialchars(mysqli_escape_string($conn, $data['password']));

		$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
		
		

		if (mysqli_num_rows($result) == 0) {
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Gagal Login!</strong> 
					  Username Tidak Terdaftar.
					</div>';
		}

		if (mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);

			//enkripsi Password hrus pake php 7, tpi di lab cuma pke versi 5
			//Matiin Aja Enkripsinya

			// if ( password_verify($password, $row['password'])){
			// 	return 1;
			// }
			// else {
			// 	echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			// 			  <strong>Gagal Login!</strong> 
			// 			  Password Salah.
			// 			</div>';
			// 			return 0;
			// }

			//cek Password
			if ($password == $row['password']) {
				return 1;
			}
			else {
				echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						  <strong>Gagal Login!</strong> 
						  Password Salah.
						</div>';
						return 0;
				}
		}

	}


	function jual($data) {
		global $conn;

		$nama = htmlspecialchars(mysqli_escape_string($conn, $data['nama']));
		$harga = htmlspecialchars(mysqli_escape_string($conn, $data['harga']));
		$deskripsi = htmlspecialchars(mysqli_escape_string($conn, $data['deskripsi']));
		$kota = htmlspecialchars(mysqli_escape_string($conn, $data['kota']));
		$kondisi = htmlspecialchars(mysqli_escape_string($conn, $data['kondisi']));
		$stok = htmlspecialchars(mysqli_escape_string($conn, $data['stok']));

		//uplod gambar
		$gambar = upload();

		if ($gambar === false) {
			return 0;
		}

		$query = "INSERT INTO tb_barang VALUES ('','$nama','$harga','$deskripsi','$gambar','$kota','$kondisi','$stok')";

		mysqli_query($conn,$query);

		return mysqli_affected_rows($conn);

	}

	function upload() {

		global $conn;

		$namaFile = $_FILES['gambar']['name'];
		$ukuranFile = $_FILES['gambar']['size'];
		$lokasi = $_FILES['gambar']['tmp_name'];
		$error = $_FILES['gambar']['error'];	

		if ($error == 4) {
			$default = "";

			return $default;
		}

		//validasi ekstensi
		$ekstensiValid = ['jpg','jpeg','png','webp'];
		
		//pisahkan namafile dan ekstensi
		$ekstensi = explode('.', "$namaFile");
		$ekstensi = strtolower(end($ekstensi));

		//cek Valid ekstensi
		if (!in_array($ekstensi, $ekstensiValid)) {
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Gagal Menjual Barang!</strong> 
					  Format File Tidak Didukung.
					</div>';
					return false;
		}

		// cek ukuran gambar terlalu besar
	    $ekstensiFile = [' > 1000000 ' ];
	    if (in_array($ukuranFile , $ekstensiFile )) {
	        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Gagal Menjual Barang!</strong> 
					 Ukuran File Terlalu Besar.
					</div>';
	        return false;
	    }

	    $namaBaru = uniqid();
	    $namaBaru .= ".";
	    $namaBaru .= $ekstensi;

	    move_uploaded_file($lokasi, 'gambar/gambarProduk/' . $namaBaru);

	    return $namaBaru;



	}


	function query($query) {

		global $conn;

		$result = mysqli_query($conn,$query);
		$rows = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}

		return $rows;

	}

	function hapus($id) {
		global $conn;

		$result = mysqli_query($conn, "SELECT * FROM tb_barang WHERE id = '$id' ");

		$row = mysqli_fetch_assoc($result);
		$namaFile = $row['gambar'];

		if (file_exists("gambar/gambarProduk/$namaFile")) {
			unlink("gambar/gambarProduk/$namaFile");
		}

		mysqli_query($conn,"DELETE FROM tb_barang WHERE id='$id'");

		return mysqli_affected_rows($conn);

	}

	function ubah($id) {
		global $conn;

		$nama = htmlspecialchars(mysqli_escape_string($conn, $_POST['nama']));
		$harga = htmlspecialchars(mysqli_escape_string($conn, $_POST['harga']));
		$deskripsi = htmlspecialchars(mysqli_escape_string($conn, $_POST['deskripsi']));
		$kota = htmlspecialchars(mysqli_escape_string($conn, $_POST['kota']));
		$kondisi = htmlspecialchars(mysqli_escape_string($conn, $_POST['kondisi']));
		$stok = htmlspecialchars(mysqli_escape_string($conn, $_POST['stok']));
		//ambil gambar lama
		$gambarLama = $_POST['gambarLama'];

		//cek apakah user menambahkan gambar lama atau tidak
		if ($_FILES['gambar']['error'] === 4) {
			$gambar = $gambarLama;
		}
		else {
			$result = mysqli_query($conn, "SELECT * FROM tb_barang WHERE id = '$id' ");

			$row = mysqli_fetch_assoc($result);
			$namaFile = $row['gambar'];

				if (file_exists("gambar/gambarProduk/$namaFile")) {
					unlink("gambar/gambarProduk/$namaFile");
				}

			$gambar = upload();
			
			}

		if (!$gambar) {
			return false;
		}

		$query = "UPDATE tb_barang SET

				nama = '$nama',
				harga = '$harga',
				deskripsi = '$deskripsi',
				gambar = '$gambar',
				kota = '$kota',
				kondisi = '$kondisi',
				stok = '$stok' WHERE id = '$id'";

		mysqli_query($conn,$query);

		return mysqli_affected_rows($conn);

	}


	function read($data) {

		global $conn;

		$panjang = strlen($data);

		if ($panjang > 100) {
			$string = substr($data, 0,70);
			echo $hasil = $string . " " . "<a href='#gambar1'>Selengkapnya....</a>"; 
		}

		else {
			echo $data;
		}

	}

	function kondisi($kondisi,$nama) {
		global $conn;

		if ($kondisi === 'Baru') {
			$nama .= " (Baru)";

			return $nama; 
		}

		else if ($kondisi === 'Lama') {
			$nama .= " (Bekas)";

			return $nama; 
		}
	}

	function cari($keyword){

		$query = "SELECT * FROM tb_barang WHERE nama LIKE '%$keyword%' OR harga like '%$keyword%' OR  kota like '%$keyword%'";

		return query($query);

	}

 ?>