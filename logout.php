<?php 
    session_start(); 
    // menghapus session
    session_destroy(); 
    // pindah ke halaman index.php
    header("location:index.php"); 
?>