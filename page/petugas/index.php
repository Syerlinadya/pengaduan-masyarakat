<?php 
	session_start();
	include '../../conn/koneksi.php';
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	elseif($_SESSION['data']['level'] != "petugas"){
		header('location:../index.php');
	}
 ?>
<!DOCTYPE html> 
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Halaman Admin </title>
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
          <i class='material-icons small'>report</i>
          <span class="links_name">Pengaduan</span>
          </a>
          <span class="tooltip">Pengaduan</span>
        </li>
        <li>
          <a href="index.php?p=tanggapan">
          <i class='material-icons small'>report_off</i>
          <span class="links_name">Tanggapan</span>
          </a>
          <span class="tooltip">Tanggapan</span>
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
   
   <script>
   let btn = document.querySelector("#btn");
   let sidebar = document.querySelector(".sidebar");
   let searchBtn = document.querySelector(".bx-search");

   btn.onclick = function() {
     sidebar.classList.toggle("active");
     if(btn.classList.contains("bx-menu")){
       btn.classList.replace("bx-menu" , "bx-menu-alt-right");
     }else{
       btn.classList.replace("bx-menu-alt-right", "bx-menu");
     }
   }
   searchBtn.onclick = function() {
     sidebar.classList.toggle("active");
   }
   

  </script>
</body>
</html>

<?php 
		if(@$_GET['p']==""){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="dashboard"){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="pengaduan"){
			include_once 'pengaduan.php';
		}
		elseif(@$_GET['p']=="pengaduan_hapus"){
			$query=mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
			$data=mysqli_fetch_assoc($query);
			unlink('../img/'.$data['foto']);
		if($data['status']=="proses"){
			$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
			header('location:index.php?p=pengaduan');
		}
		elseif($data['status']=="selesai"){
			$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
			if($delete){
				$delete2=mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				header('location:index.php?p=pengaduan');
			}	
		}

		}
		elseif(@$_GET['p']=="more"){
			include_once 'more.php';
		}
		elseif(@$_GET['p']=="tanggapan"){
			include_once 'tanggapan.php';
		}
		elseif(@$_GET['p']=="respon"){
			include_once 'respon.php';
		}
		elseif(@$_GET['p']=="tanggapan_hapus"){
			
			$query = mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_tanggapan='".$_GET['id_tanggapan']."'");
			if($query){
				header('location:index.php?p=tanggapan_show');
			}
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