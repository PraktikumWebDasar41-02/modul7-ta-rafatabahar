<form method="post">
	Nama: <input type="text" name="nama"><br>
	NIM: <input type="text" name="nim"><br>
	Tanggal Lahir: <input type="date" name="tl"><br>
	Jenis Kelamin :
	<select name="jk">
		<option value="pilih">=====Pilih=======</option>
		<option value="Laki-laki">Laki-laki</option>
		<option value="Perempuan">Perempuan</option>
	</select><br>
	Program Studi :
	<select name="prodi">
		<option value="pilih">=====Pilih=======</option>
		<option value="D3 Manajemen Informatika">D3 Manajemen Informatika</option>
		<option value="D3 Teknik Informatika">D3 Teknik Informatika</option>
		<option value="D3 Manajemen Pemasaran">D3 Manajemen Pemasaran</option>
		<option value="D3 Komputerisasi Akuntansi">D3 Komputerisasi Akuntansi</option>
	</select><br>
	Fakultas : <br><input type="radio" name="fakultas" value="Fakultas Ilmu terapan"> Fakultas Ilmu terapan<br>
	<input type="radio" name="fakultas" value="Fakultas Ekonomi dan Bisnis"> Fakultas Ekonomi dan Bisnis<br>
	<input type="radio" name="fakultas" value="Fakultas Komunikasi dan Bisnis"> Fakultas Komunikasi dan Bisnis<br>
	Asal: <input type="text" name="asal"><br>
	Moto Hidup: <textarea name="moto"></textarea><br>
	<input type="submit" name="submit" value="kirim">
</form>

<?php
	if (isset($_POST['submit'])) {
		$koneksi = mysqli_connect('localhost','root','','jurnal_7');

		$nama = $_POST['nama'];
		$nim = $_POST['nim'];
		$tl = $_POST['tl'];
		$jk = $_POST['jk'];
		$prodi = $_POST['prodi'];
		$fakultas;
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
			if (mysqli_query($koneksi, "INSERT INTO mahasiswa VALUES ('$nim','$nama', '$tl', '$jk', '$prodi', '$fakultas', '$asal', '$moto')")) {
				header("Location:tampil.php");
			}
		}else {
			echo "Isi data dengan benar";
		}




	}

?>
