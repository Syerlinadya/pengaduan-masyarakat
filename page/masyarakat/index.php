<?php 
	session_start();
	error_reporting(0);
	include '../../conn/koneksi.php';
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	elseif($_SESSION['level'] != "masyarakat"){
		header('location:../index.php');
	}
 ?>
<!DOCTYPE html> 
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Halaman Masyarakat </title>
    <link rel="stylesheet" href="../../css/styleadmin.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
    <!--DATABLES JQUERY  -->
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

    <script src="../../js/main.js"></script>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
   <div class="sidebar">
     <div class="logo_content">
       <div class="logo">
         <div class="logo_name">Pengaduan Masyarakat</div>
       </div>
       <i class='material-icons small' id="btn">menu</i>
     </div>
     <ul class="nav_list">
        <li>
          <a href="#">
            <i class='material-icons small'>account_circle</i>
            <span class="links_name"><?php echo ucwords($_SESSION['data']['nama_petugas']); ?></span></span>
          </a>
          <span class="tooltip"><?php echo ucwords($_SESSION['data']['nama_petugas']); ?></span></span>
        </li>
        <li>
          <a href="index.php?p=dashboard">
          <i class='material-icons small'>dashboard</i>
          <span class="links_name">Dashboard</span>
          </a>
          <span class="tooltip">Dashboard</span>
        </li>
        <li>
          <a href="index.php?p=pengaduan">
          <i class="material-icons small">report</i>
          <span class="links_name">List Pengaduan</span>
          </a>
          <span class="tooltip">List Pengaduan</span>
        </li>
        <li>
          <a href="../../index.php?p=logout">
          <i class='material-icons small'>logout</i>
          <span class="links_name">Logout</span>
          </a>
          <span class="tooltip">Logout</span>
        </li>
     </ul>
   </div>
</body>
</html>

<?php 
		if(@$_GET['p']==""){
			include_once 'dashboard.php';
		}
    elseif(@$_GET['p']=="pengaduan"){
			include_once 'pengaduan.php';
		}
		elseif(@$_GET['p']=="dashboard"){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="pengaduan_hapus"){
			$query=mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
			$data=mysqli_fetch_assoc($query);
			unlink('../img/'.$data['foto']);
			if($data['status']=="proses"){
				$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				header('location:index.php?p=dashboard');
			}
			elseif($data['status']=="selesai"){
				$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				if($delete){
					$delete2=mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
					header('location:index.php?p=dashboard');
				}	
			}

		}
		elseif(@$_GET['p']=="detail"){
			include_once 'detail.php';
		}
	 ?>
    <script type="text/javascript" src="../js/materialize.min.js"></script>    
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.sidenav');
          var instances = M.Sidenav.init(elems);
        });

        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.modal');
          var instances = M.Modal.init(elems);
        });
        
        $(document).ready(function(){
          $("#example").DataTable({
              dom: "lfrtip",
              lengthMenu: [5, 10, 20, 50, 100, 200, 500],
              scrollY:        200,
              scrollCollapse: true,
              scroller:       true
          });
          $("select").formSelect();
      });
    </script>