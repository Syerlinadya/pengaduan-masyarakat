<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
   <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
     
</head>
<body>
    <div>
        <?php
            include 'conn/koneksi.php';
            if(@$_GET['p']==""){
                include_once 'login.php';
            }elseif(@$_GET['p']=="login"){
                include_once 'login.php';
            }elseif(@$_GET['p']=="logout"){
                include_once 'logout.php';
            }elseif(@$_GET['p']=="daftar"){
                include_once 'daftar.php';
            }
        ?>
    </div>
</body>
</html>