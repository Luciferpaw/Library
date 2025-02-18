<?php
    // web local
    $server='localhost';
    $username='root';
    $password='';
    $database='db_buku';

    // web hosting
    // $server='sql300.infinityfree.com';
    // $username='if0_37572175';
    // $password='alfredo081292';
    // $database='if0_37572175_db_buku';

    $koneksi=mysqli_connect($server,$username,$password,$database) or die ('Hidupkan Server');
    ?>