<?php
	$koneksi = mysqli_connect('localhost','root','','jurnal_7');

	if (isset($_GET['nim'])) {
		mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim = '".$_GET['nim']."' ");
		header("Location:tampil.php");
	}

?>
<a href="form.php">Input data baru</a><br>

<form method="post">
	Cari: <input type="text" name="cari">
	<input type="submit" name="submit_cari" value="cari">
</form><br>

<table border="1">
	<thead>
		<td>NO</td>
		<td>NIM</td>
		<td>Nama</td>
		<td>Program Studi</td>
		<td>Aksi</td>
	</thead>
	<tbody>
		<?php
			$hasil;
			$mark = "";
			if (isset($_POST['submit_cari'])) {
				$hasil = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim LIKE '%".$_POST['cari']."%' OR nama LIKE '%".$_POST['cari']."%' ");
				$mark = $_POST['cari'];
			}else{
				$hasil = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
			}

			$i = 1;
			while ($row = mysqli_fetch_array($hasil)) {
				echo "<tr>";
				echo "<td>$i</td>";
				echo "<td>".str_replace($mark,"<mark>$mark</mark>",$row['nim']) ."</td>";
				echo "<td>".str_replace($mark,"<mark>$mark</mark>",$row['nama']) ."</td>";
				echo "<td>".$row['prodi']."</td>";
				echo "<td><a href='tampil.php?nim=".$row['nim']."'>Hapus</a> | <a href='edit.php?nim=".$row['nim']."'>Edit</a></td>";
				echo "</tr>";
				$i++;
			}
		?>
	</tbody>
</table>
