<?php 

	session_start();
	require 'php/koneksi.php';
	require 'php/function.php';

	
	if (isset($_SESSION['login'])) {
		header('location: index.php');
	}

	if (isset($_POST['login']) > 0) {
		if (login($_POST) > 0) {

			//setsession
			$_SESSION['login'] = true;

			echo "<script>
					alert('Berhasil Login');
					window.location.href = 'index.php'
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
			<h1>Halaman Login</h1>
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
		  <div class="form-group form-check">
		    <input type="checkbox" class="form-check-input" id="exampleCheck1">
		    <label class="form-check-label" for="exampleCheck1"> Ingat Saya</label>
		  </div>
		  <button type="submit" class="btn btn-primary" name="login">Sign In</button>
		  </form><br><br>
		  Belum Punya Akun? <a href="register.php">Buat Akun</a>
		</div>
	
	
		
</body>
</html>