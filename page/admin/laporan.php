<section class="home_content">
    <nav>
        <div class="sidebar-button">
            <i class='material-icons small'>summarize</i>
            <span class="white-text center-align">LAPORAN</span>
        </div>
        <div class="icon">
        <a class="waves-effect waves-light" href="cetak.php" target="_BLANK"><i class='material-icons small'>print</i></a>
        <!-- <a href="javascript:window.print()" class="button print">Print Page</a> -->
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col card-large">
                <div class="card ">
                    <div class="card-content">
					<table id="example" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK Pelapor</th>
                            <th>Nama Pelapor</th>
                            <th>Nama Petugas</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Ditanggapi</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody> 
                    <?php 
                        $no=1;
                        $query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas ORDER BY tgl_pengaduan DESC");
                        while ($r=mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $r['nik']; ?></td>
                            <td><?php echo $r['nama']; ?></td>
                            <td><?php echo $r['nama_petugas']; ?></td>
                            <td><?php echo $r['tgl_pengaduan']; ?></td>
                            <td><?php echo $r['tgl_tanggapan']; ?></td>
                            <td><?php echo $r['status']; ?></td>
                            <td>
                                <a class="btn indigo lighten-4 modal-trigger" href="#laporan?id_tanggapan=<?php echo $r['id_tanggapan'] ?>">Detail</a>
                            </td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
                        <!-- Modal Detail -->
                        <div id="laporan?id_tanggapan=<?php echo $r['id_tanggapan'] ?>" class="modal">
                        <div class="modal-content">
                            <h4 class="indigo-text">Detail</h4>
                            <div class="col s12 m6">
                                <p>NIK : <?php echo $r['nik']; ?></p>
                                <p>Dari : <?php echo $r['nama']; ?></p>
                                <p>Petugas : <?php echo $r['nama_petugas']; ?></p>
                                <p>Tanggal Masuk : <?php echo $r['tgl_pengaduan']; ?></p>
                                <p>Tanggal Ditanggapi : <?php echo $r['tgl_tanggapan']; ?></p>
                                <?php 
                                    if($r['foto']=="kosong"){ ?>
                                        <img src="../../img/noImage.png" width="100">
                                <?php	}else{ ?>
                                    <img width="100" src="../../img/<?php echo $r['foto']; ?>">
                                <?php }
                                ?>
                                <br><b>Pesan</b>
                                <p><?php echo $r['isi_laporan']; ?></p>
                                <br><b>Respon</b>
                                <p><?php echo $r['tanggapan']; ?></p>
                            </div>
                        </div>
                        <div class="modal-footer col s12">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                        </div>
                        </div>
    <!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
                        </tr>
                            <?php  
                                }
                            ?>
                        </tbody>
                        </table>   
                    </div>            
                </div>            
            </div>            
        </div>
    </div>     
</section>