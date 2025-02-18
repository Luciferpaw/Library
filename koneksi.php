<?php
    // web local
    $server='localhost';
    $username='root';
    $password='';
    $database='db_buku';

    // web hosting
    // $server='sql300.infinityfree.com';
    // $username='if0_37572155';
    // $password='LARKA180909';
    // $database='if0_37572155_db_buku';

    $koneksi=mysqli_connect($server,$username,$password,$database) or die ('Hidupkan Server');
?>