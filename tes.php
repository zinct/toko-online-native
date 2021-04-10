<?php 

	require 'php/koneksi.php';

	$echo = uniqid();

	echo $echo;die;

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<form method="post" enctype="multipart/form-data">
 		<ul>
 			<li>
 				<label for="username">Username : </label>
 				<input type="text" name="username" id="username" required>
 			</li>
 			<li>
 				<label for="gambar">Gambar : </label>
 				<input type="file" name="gambar" id="gambar" >
 			</li>
 			<li>
 				<button name="kirim" type="submit">kirim</button>
 			</li>
 		</ul>
 	</form>
 </body>
 </html>