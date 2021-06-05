<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <!-- Form login -->
        <form method="POST" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="material-icons small">person</i>
            <input type="text" name="username" placeholder="Username" required/>
          </div>
          <div class="input-field">
            <i class="material-icons small">lock</i>
            <input type="password" name="password" placeholder="Password" autocomplete/>
          </div>
          <input type="submit" name="login" value="Login" class="btn solid" />
        </form>

        <!-- Form Register -->
        <form method="POST" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="material-icons small">remember_me</i>
            <input type="text" name="nik" placeholder="NIK" required>
          </div>
          <div class="input-field">
            <i class="material-icons small">badge</i>
            <input type="text" name="nama" placeholder="Name" required>
          </div>
          <div class="input-field">
            <i class="material-icons small">person</i>
            <input type="text" name="username" placeholder="Username" required>
          </div>
          <div class="input-field">
            <i class="material-icons small">lock</i>
            <input type="password" name="password" placeholder="Password" autocomplete>
          </div>
          <div class="input-field">
            <i class="material-icons small">call</i>
            <input type="text" name="telp" placeholder="Phone" required>
          </div>
          <div class="input-field">
            <i class="material-icons small">cake</i>
            <input type="number" name="umur" placeholder="Age" required>
          </div>
          <input type="submit" name="daftar" class="btn" value="Sign up" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>You don't have an account ?</h3>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="img/sent.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>You have an account ?</h3>
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="img/logo.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="js/app.js"></script>
</body>

<?php
// LOGIN
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($koneksi,$_POST['username']);
		$password = mysqli_real_escape_string($koneksi,md5($_POST['password']));
	
		// memproses query ke database
		$sql = mysqli_query($koneksi,"SELECT * FROM masyarakat WHERE username='$username' AND password='$password' ");
		// menghasilkan jumlah baris data dari database
		$cek = mysqli_num_rows($sql);
		// menghasilkan array data dari database
		$data = mysqli_fetch_assoc($sql);
	
		$sql2 = mysqli_query($koneksi,"SELECT * FROM petugas WHERE username='$username' AND password='$password' ");
		// menghasilkan jumlah baris data dari database
		$cek2 = mysqli_num_rows($sql2);
		// menghasilkan array data dari database
		$data2 = mysqli_fetch_assoc($sql2);

		if($cek>0){
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['data']=$data;
			$_SESSION['level']='masyarakat';
			// pindah ke halaman masyarakat jika levelnya = masyarakat
			header('location:page/masyarakat/');
		}
		elseif($cek2>0){
			if($data2['level']=="admin"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				// pindah ke halaman admin jika levelnya = admin
				header('location:page/admin/');
			}
			elseif($data2['level']=="petugas"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				// pindah ke halaman petugas jika levelnya = petugas
				header('location:page/petugas/');
			}
		}
		else{
			echo "<script>alert('Gagal Login')</script>";
		}
	}

// REGISTER
  if(isset($_POST['daftar'])){
    $nik = mysqli_real_escape_string($koneksi,$_POST['nik']);
    $nama = mysqli_real_escape_string($koneksi,$_POST['nama']);
    $username = mysqli_real_escape_string($koneksi,$_POST['username']);
    $password = mysqli_real_escape_string($koneksi,md5($_POST['password']));
    $telp = mysqli_real_escape_string($koneksi,$_POST['telp']);
    $umur = mysqli_real_escape_string($koneksi,$_POST['umur']);

  // memproses query ke database
  $sql = mysqli_query($koneksi,"INSERT INTO masyarakat VALUES ('".$_POST['nik']."','".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."','".$_POST['umur']."')");
  if($sql){
        echo "<script>alert('Data Tesimpan')</script>";
        header('location:index.php?p=login');
    }

  }
?>