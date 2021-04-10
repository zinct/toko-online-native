<?php 

	require 'php/koneksi.php';
	require 'php/function.php';
	session_start();

	if (isset($_SESSION['login'])) {
		header('location: index.php');
	}

	if (isset($_POST['login']) > 0) {
		if (register($_POST) > 0) {
			echo "<script>
					alert('Berhasil Membuat Akun');
					window.location.href = 'login.php'
				  </script>
				  ";
		}
	}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Halaman login</title>	
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/box.css">
</head>
<body>
	<form method="post">	
		<div class="box p-5">
			<h1>Register</h1>
		  <div class="form-group ">
		    <label for="exampleInputEmail1">Username</label>
		    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan username..." name="username">
		    <small id="emailHelp" class="form-text text-muted"></small>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Password</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Masukan password..." name="password">
		    <small id="emailHelp" class="form-text text-muted"></small>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Masukan Kembali Password</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Masukan Kembali password..." name="password2">
		    <small id="emailHelp" class="form-text text-muted"></small>
		  </div>
		  <button type="submit" class="btn btn-primary" name="login">Submit</button>
		  </form><br><br>
		  Sudah Punya Akun?<a href="login.php"> Login</a>
		</div>
	
</body>
</html>