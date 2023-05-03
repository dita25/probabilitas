<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        nama anda : <input type="text" name="nama" id="">
        <input type="submit" value="input" name="input">
    </form>
</body>

</html>

<?php
include "koneksi.php";

$id = $_POST["id"];
$nim = $_POST["nim"];
$gender = $_POST["gender"];
$course = $_POST["course"];
$daytime = $_POST["daytime"];
$age = $_POST["age"];
$status = $_POST["status"];

mysqli_query($conn, "INSERT INTO data_mahasiwa VALUES ('$id', '$nim', '$gender', '$course', '$daytime', '$age', '$status')")
    or die(mysqli_error($conn));
?>