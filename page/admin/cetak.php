
<head>
    <style>
      *, *:before, *:after {
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    }

    * {
    font-family: Open Sans;
    }

    a, input, tr {
    outline: none;
    transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -webkit-transition: all .2s ease-in-out;
    }

    table {
    width: 700px;
    margin: 0 auto 3em auto;
    border-collapse: collapse;
    }
    th {
    background: rgba(20,133,204,0.2);
    }
    tbody tr:hover {
    background: rgba(20,133,204,0.1);
    }
    th, td {
    border: 1px solid #CCC;
    padding: 5px;
    width: 20%;
    font-size: 0.9em;
    }

    @media print {
    table {
        width: 100%;
        margin: 0;
    } 
    tr {
        page-break-inside: avoid; /* Prevents rows from breaking */
        display: block; /* Needed in order for page-break to work */
    }
    th, td {
        width: 135px; /* To force width to columns */
    }
    .print.button {
        display: none;
    }
    }

    </style>
</head>
<body>   
    <h1 align="center">Laporan Layanan Pengaduan Masyarakat</h1>    
    <div class="row">
        <table id="example" class="display" cellpadding="0" cellspacing="0">
        <thead>
            <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">NIK Pelapor</th>
                <th scope="col">Nama Pelapor</th>
                <th scope="col">Nama Petugas</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Tanggal Ditanggapi</th>
                <th scope="col">Status</th scope="col">
            </tr>
        </thead>
        <tbody>
        <?php 
            include '../../conn/koneksi.php';
            $no=1;
            $query = mysqli_query($koneksi,
            "SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik 
            INNER JOIN tanggapan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan 
            INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas ORDER BY tgl_pengaduan DESC");
            while ($r=mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $r['nik']; ?></td>
                <td><?php echo $r['nama']; ?></td>
                <td><?php echo $r['nama_petugas']; ?></td>
                <td><?php echo $r['tgl_pengaduan']; ?></td>
                <td><?php echo $r['tgl_tanggapan']; ?></td>
                <td><?php echo $r['status']; ?></td>
            </tr>
            </tbody>
            <?php	
                }
            ?>
        </table>  
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>