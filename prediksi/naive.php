<?php
    require 'koneksi.php';

    //HITUNG JUMLAH TOTAL DATA
    function totalDataTraining(){
        global $conn;
        return (int) mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM data_mahasiswa"))[0];
    }

    //HITUNG JUMLAH DATA STATUS MAHASISWA DAN KELAS BONUS
    function jumlahDataKelas(){
        global $conn;
        $query = "SELECT COUNT(*) FROM data_mahasiswa WHERE status=";

        $jumlahDataStatus['GRADUATE'] = (int) mysqli_fetch_row(mysqli_query($conn, $query . "'GRADUATE'"))[0];
        $jumlahDataStatus['ENROLL'] = (int) mysqli_fetch_row(mysqli_query($conn, $query . "'ENROLL'"))[0];
        $jumlahDataStatus['DROPOUT'] = (int) mysqli_fetch_row(mysqli_query($conn, $query . "'DROPOUT'"))[0];
        return $jumlahDataStatus;
    } 
    // HITUNG NILAI PROBABILITAS SEBELUMNYA
    function probablitasSebelumnya(){
        //Probabilitas sebelumnya = jumlah data kelas (GRADUATE|ENROLL|DROPOUT)/ total data training
        $kelas['GRADUATE'] = jumlahDataKelas()['GRADUATE'] / totalDataTraining();
        $kelas['ENROLL'] = jumlahDataKelas()['ENROLL'] / totalDataTraining();
        $kelas['DROPOUT'] = jumlahDataKelas()['DROPOUT'] / totalDataTraining();
        return $kelas;
    }
    //HITUNG KONDISI PROBABILITAS
    function kondisiProbabilitas($nama_kolom, $nilai){
        global $conn;
        $query = "SELECT COUNT($nama_kolom) FROM data_mahasiswa WHERE $nama_kolom = '$nilai' AND status=";

        /*KONDISI PROBABILITAS = JUMLAH DATA ATRIBUT(GRADUATE|ENROLL|DROPOUT)/ JUMLAH DATA KELAS (GRADUATE|ENROLL|DROPOUT)*/
        $kondisiProbabilitas['GRADUATE'] = (int) mysqli_fetch_row(mysqli_query($conn, $query. "'GRADUATE'"))[0]/jumlahDataKelas()['GRADUATE'];
        $kondisiProbabilitas['ENROLL'] = (int) mysqli_fetch_row(mysqli_query($conn, $query . "'ENROLL'"))[0] / jumlahDataKelas()['ENROLL'];
        $kondisiProbabilitas['DROPOUT'] = (int) mysqli_fetch_row(mysqli_query($conn, $query . "'DROPOUT'"))[0] / jumlahDataKelas()['DROPOUT'];
        return $kondisiProbabilitas;
    }
    // HITUNG POSTERIOR PROBABILITAS
    function posteriorProbabilitas($data){
        $atribut['gender'] = kondisiProbabilitas('gender', $data['gender']);
        $atribut['course'] = kondisiProbabilitas('course', $data['course']);
        $atribut['daytime'] = kondisiProbabilitas('daytime', $data['daytime']);
        $atribut['age'] = kondisiProbabilitas('age', $data['age']);
        
        /*POSTEERIOR PROBABILITAS = KONDISI PROBABILITAS ATRIBUT KE 1 X...X KONDISI PROBABILITAS ATRIBUT KE-N X PRIOR PROBABILITAS(GRADUATE|ENROLL|DROPOUT)*/
        $probabilitas['GRADUATE'] = $atribut['gender']['GRADUATE'] * $atribut['course']['GRADUATE'] * $atribut['daytime']['GRADUATE'] * $atribut['age']['GRADUATE'] * probablitasSebelumnya()['GRADUATE'];
        $probabilitas['ENROLL'] = $atribut['gender']['ENROLL'] * $atribut['course']['ENROLL'] * $atribut['daytime']['ENROLL'] * $atribut['age']['ENROLL'] * probablitasSebelumnya()['ENROLL'];
        $probabilitas['DROPOUT'] = $atribut['gender']['DROPOUT'] * $atribut['course']['DROPOUT'] * $atribut['daytime']['DROPOUT'] * $atribut['age']['DROPOUT'] * probablitasSebelumnya()['DROPOUT'];
    }
        // MENENTUKKAN STATUS MAHASISWA GRADUATE, ENROLL, ATAU DROPOUT
    if ($probabilitas['GRADUATE'] > $probabilitas['ENROLL'] && $probabilitas['GRADUATE'] > $probabilitas['DROPOUT']) {
        return 'GRADUATE';
        } else if ($probabilitas['ENROLL'] > $probabilitas['GRADUATE'] && $probabilitas['ENROLL'] > $probabilitas['DROPOUT']) {
            return 'ENROLL';
        } else if ($probabilitas['DROPOUT'] > $probabilitas['GRADUATE'] && $probabilitas['DROPOUT'] > $probabilitas['ENROLL']) {
            return 'DROPOUT';
        } else {
            return 'TIDAK DAPAT DITENTUKAN';
        }

    
?>