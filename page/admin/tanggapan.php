<section class="home_content">
    <nav>
        <div class="sidebar-button">
            <i class='material-icons small'>report_off</i>
            <span class="white-text center-align">TANGGAPAN</span>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col s12 l12">
                <div class="card card-small">
                    <div class="card-content">
                        <table id="example" class="display" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Petugas</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Ditanggapi</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no=1;
                            $query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas ORDER BY tanggapan.id_pengaduan DESC");
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
                                    <a class="btn modal-trigger indigo lighten-4" href="#detail?id_tanggapan=<?php echo $r['id_tanggapan'] ?>">Detail</a>  
                                    <a class="btn amber accent-3" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="index.php?p=tanggapan_hapus&id_tanggapan=<?php echo $r['id_tanggapan'] ?>">Hapus</a>
                                </td>

                                <!-- Modal Detail -->
                                <div id="detail?id_tanggapan=<?php echo $r['id_tanggapan'] ?>" class="modal">
                                    <div class="modal-content">
                                        <h4 class="indigo-text">Detail</h4>
                                        <div class="col s12">
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