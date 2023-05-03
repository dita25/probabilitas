<?php
    $conn = mysqli_connect("localhost","root","","statistika");
    if (!$conn){
        die("koneksi gagal".mysqli_connect_errno());
    }
?>