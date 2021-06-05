<section class="home_content">
	<nav>
		<div class="sidebar-button">
			<i class="material-icons small">dashboard</i>
			<span class="white-text">DASHBOARD</span>
		</div>
    </nav>
	<div class="container ">
		<div class="row offset-6">
			<div class="col s12 m6 l6 center-align">
				<div class="card lime accent-2">
					<div class="card-content">
						<i class="material-icons large">report</i>
							<?php 
								$query = mysqli_query($koneksi,"SELECT * FROM pengaduan");
								$pengaduan = mysqli_num_rows($query);
								if($pengaduan<1){
									$pengaduan=0;
								}
							?>
							<span class="card-title">Laporan Masuk <b class="right"><?php echo $pengaduan; ?></b></span>
					</div>
				</div>
			</div>
			<div class="col s12 m6 l6 center-align">
				<div class="card green accent-3">
					<div class="card-content">
						<i class="material-icons large">report_off</i>
							<?php 
								$query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE status='selesai'");
								$pengaduan = mysqli_num_rows($query);
								if($pengaduan<1){
									$pengaduan=0;
								}
							?>
							 <span class="card-title">Laporan Selesai <b class="right"><?php echo $pengaduan; ?></b></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>