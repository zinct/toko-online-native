<?php 
  
  require 'php/koneksi.php';
  require 'php/function.php';

  session_start();

  if (!isset($_SESSION['login'])) {
    header('location: login.php');
  }


  if (isset($_POST['jual'])) {
    if (jual($_POST) > 0) {
      echo "<script>
          alert('Berhasil Menjual Barang');
          window.location.href = 'index.php';
          </script>
          ";
    }
    else {
      mysqli_error($conn);
    }
  }

 ?>




<!DOCTYPE html>
<html>
<head>
	<title></title>
  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/box.css">
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
    <div class="box p-5 shadow-lg p-3 mb-5 bg-white rounded">
      <h1 class="m-5">Jual Barang</h1>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Nama Barang</label>
          <input type="text" class="form-control" id="inputEmail4" placeholder="Nama..." name="nama" required>
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Harga Barang</label>
          <input type="text" class="form-control" id="inputPassword4"  placeholder="Harga..." name="harga" required>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Deskripsi Barang</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Deskpripsi..." name="deskripsi" required=""></textarea>
      </div>
     <div class="input-group mb-3">
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="inputGroupFile02" name="gambar">
    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Gambar Produk</label>
  </div>
</div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputCity">Kota</label>
          <input type="text" class="form-control" id="inputCity" placeholder="kota..." name="kota" required="">
        </div>
        <div class="form-group col-md-4">
          <label for="inputState">Kondisi</label>
          <select id="inputState" class="form-control" name="kondisi" required="">
            <option selected></option>
            <option  value="Baru">Baru</option>
            <option value="Lama">Bekas</option>
          </select>
        </div>
        <div class="form-group col-md-2">
          <label for="inputZip">Stock</label>
          <input type="number" max="100" value="1" class="form-control" id="inputZip" name="stok" required="">
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="jual">Menjual</button>

      <br><br>
      Ingin Kembali? <a href="index.php"> Kembali</a>
  </div>
</form>
</body>
</html>