<?php
  $koneksi = mysqli_connect('localhost','root','','jurnal_7');
  if (isset($_GET['nim'])) {
    $pk = $_GET['nim'];
    $row = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM mahasiswa WHERE nim = '$pk' "));
  }

?>

<form method="post">
	Nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>
	NIM: <input type="number" name="nim" value="<?php echo $row['nim']; ?>" readonly><br>
	Tanggal Lahir: <input type="date" name="tl" value="<?php echo $row['tanggal_lahir']; ?>"><br>
	Jenis Kelamin :
	<select name="jk">
    <option value="pilih">=====Pilih=======</option>
		<option value="Laki-laki" <?php if($row['jenis_kelamin']=="Laki-laki")echo "Selected"; ?>>Laki-laki</option>
		<option value="Perempuan" <?php if($row['jenis_kelamin']=="Perempuan")echo "Selected"; ?>>Perempuan</option>
	</select><br>
	Program Studi :
	<select name="prodi">
    <option value="pilih">=====Pilih=======</option>
		<option value="D3 Manajemen Informatika" <?php if($row['prodi']=="D3 Manajemen Informatika")echo "Selected"; ?>>D3 Manajemen Informatika</option>
		<option value="D3 Teknik Informatika" <?php if($row['prodi']=="D3 Teknik Informatika")echo "Selected"; ?>>D3 Teknik Informatika</option>
		<option value="D3 Manajemen Pemasaran" <?php if($row['prodi']=="D3 Manajemen Pemasaran")echo "Selected"; ?>>D3 Manajemen Pemasaran</option>
		<option value="D3 Komputerisasi Akuntansi" <?php if($row['prodi']=="D3 Komputerisasi Akuntansi")echo "Selected"; ?>>D3 Komputerisasi Akuntansi</option>
	</select><br>
	Fakultas : <br><input type="radio" name="fakultas" value="Fakultas Ilmu terapan" <?php if($row['fakultas']=="Fakultas Ilmu terapan")echo "checked"; ?>> Fakultas Ilmu terapan<br>
	<input type="radio" name="fakultas" value="Fakultas Ekonomi dan Bisnis" <?php if($row['fakultas']=="Fakultas Ekonomi dan Bisnis")echo "checked"; ?>> Fakultas Ekonomi dan Bisnis<br>
	<input type="radio" name="fakultas" value="Fakultas Komunikasi dan Bisnis" <?php if($row['fakultas']=="Fakultas Komunikasi dan Bisnis")echo "checked"; ?>> Fakultas Komunikasi dan Bisnis<br>
	Asal: <input type="text" name="asal" value="<?php echo $row['asal']; ?>"><br>
	Moto Hidup: <textarea name="moto"><?php echo $row['moto_hidup']; ?></textarea><br>
	<input type="submit" name="submit" value="kirim">
</form>

<?php

  if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
		$nim = $_POST['nim'];
		$tl = $_POST['tl'];
		$jk = $_POST['jk'];
		$prodi = $_POST['prodi'];
		$fakultas = $_POST['fakultas'];
		$asal = $_POST['asal'];
		$moto = $_POST['moto'];

		$cek = true;

    if (empty($nim)) {
			echo "Nim tidak boleh kosong<br>";
			$cek = false;
		}else {
			if (!is_numeric($nim)) {
				echo "Nim harus angka";
				$cek = false;
			}
		}

		if (empty($nama)) {
			echo "nama tidak boleh kosong<br>";
			$cek = false;
		}

		if (empty($tl)) {
			echo "Tanggal lahir tidak boleh kosong<br>";
			$cek = false;
		}

		if ($jk=="pilih") {
			echo "Harus memilih jenis kelamin";
			$cek = false;
		}

		if ($prodi=="pilih") {
			echo "Harus memilih Prodi";
			$cek = false;
		}

		if (empty($_POST['fakultas'])) {
			echo "Harus memilih Fakultas";
			$cek = false;
		}else {
			$fakultas = $_POST['fakultas'];
		}

		if (empty($asal)) {
			echo "Asal tidak boleh kosong<br>";
			$cek = false;
		}

		if (empty($moto)) {
			echo "Moto tidak boleh kosong<br>";
			$cek = false;
		}



		if ($cek) {
			if (mysqli_query($koneksi, "UPDATE mahasiswa SET nama = '$nama', tanggal_lahir = '$tl', jenis_kelamin = '$jk', prodi = '$prodi', fakultas = '$fakultas', asal = '$asal', moto_hidup = '$moto' WHERE nim = '$pk' ")) {
				header("Location:tampil.php");
			}
		}
  }

?>
