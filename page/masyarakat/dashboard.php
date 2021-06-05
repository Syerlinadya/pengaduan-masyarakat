<section class="home_content">
	<nav>
		<div class="sidebar-button">
			<i class="material-icons small">dashboard</i>
			<span class="white-text">DASHBOARD</span>
		</div>
    </nav>
	<div class="container ">
		<div class="row">
			<div class="col ">
				<div class="card" style="width:900px">
					<div class="card-content">
					<table class="display" style="width: 100%;">
					<tr>
						<td><h4 class=" hide-on-med-and-down">Tulis Laporan</h4></td>
					</tr>
					<tr>
						<td style="padding: 20px;">
							<form method="POST" enctype="multipart/form-data">
								<textarea class="materialize-textarea" name="laporan" placeholder="Tulis Laporan"></textarea><br><br>
								<label>Gambar</label>
								<input type="file" name="foto"><br><br>
								<input type="submit" name="kirim" value="Kirim" class="btn indigo darken-4">
							</form>
						</td>
					</tr>
					<table>

					<?php 
						if(isset($_POST['kirim'])){
							$nik = $_SESSION['data']['nik'];
							$tgl = date('Y-m-d');

							$foto = $_FILES['foto']['name'];
							$source = $_FILES['foto']['tmp_name'];
							$folder = '../../img/';
							$listeks = array('jpg','png','jpeg');
							$pecah = explode('.', $foto);
							$eks = $pecah['1'];
							$size = $_FILES['foto']['size'];
							$nama = date('dmYis').$foto;

							if($foto !=""){
								if(in_array($eks, $listeks)){
									if($size<=10000000){
										move_uploaded_file($source, $folder.$nama);
										$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['laporan']."','$nama','proses')");

										if($query){
											echo "<script>alert('Pengaduan Akan Segera di Proses')</script>";
											echo "<script>location='index.php';</script>";
										}

									}
									else{
										echo "<script>alert('Akuran Gambar Tidak Lebih Dari 100KB')</script>";
									}
								}
								else{
									echo "<script>alert('Format File Tidak Di Dukung')</script>";
								}
							}
							else{
								$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['laporan']."','noImage.png','proses')");
								if($query){
									echo "<script>alert('Pengaduan Akan Segera Ditanggapi')</script>";
									echo "<script>location='index.php';</script>";
								}
							}

						}

					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>