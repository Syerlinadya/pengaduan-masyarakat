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
						<i class="material-icons large">pending_actions</i>
                        <?php 
                            $query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE status='proses'");
                            $jlmmember = mysqli_num_rows($query);
                            if($jlmmember<1){
                                $jlmmember=0;
                            }
                        ?>
							<span class="card-title">Laporan Status Proses <b class="right"><?php echo $jlmmember; ?></b></span>
					</div>
				</div>
			</div>
			<div class="col s12 m6 l6 center-align">
				<div class="card green accent-3">
					<div class="card-content">
						<i class="material-icons large">report_off</i>
                        <?php 
                            $query = mysqli_query($koneksi,"SELECT * FROM tanggapan WHERE id_petugas='".$_SESSION['data']['id_petugas']."'");
                            $jlmmember = mysqli_num_rows($query);
                            if($jlmmember<1){
                                $jlmmember=0;
                            }
                        ?>
							 <span class="card-title">Laporan Selesai <b class="right"><?php echo $jlmmember; ?></b></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>