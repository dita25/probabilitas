<?php

// Menentukan jumlah cluster
$k = 3;

// Contoh data
$data = array(
    array('gender' => 'male', 'course' => 'programming', 'daytime' => 'morning', 'age' => 23),
    array('gender' => 'female', 'course' => 'design', 'daytime' => 'afternoon', 'age' => 21),
    array('gender' => 'male', 'course' => 'programming', 'daytime' => 'evening', 'age' => 25),
    array('gender' => 'male', 'course' => 'programming', 'daytime' => 'morning', 'age' => 27),
    array('gender' => 'female', 'course' => 'design', 'daytime' => 'evening', 'age' => 24),
    array('gender' => 'male', 'course' => 'design', 'daytime' => 'afternoon', 'age' => 22),
    array('gender' => 'female', 'course' => 'programming', 'daytime' => 'morning', 'age' => 20),
    array('gender' => 'male', 'course' => 'design', 'daytime' => 'evening', 'age' => 26),
    array('gender' => 'female', 'course' => 'programming', 'daytime' => 'afternoon', 'age' => 23),
    array('gender' => 'male', 'course' => 'programming', 'daytime' => 'morning', 'age' => 21)
);

// Menghitung jarak antara dua data
function hitung_jarak($data1, $data2) {
    $jarak = 0;
    $jarak += ($data1['gender'] !== $data2['gender']) ? 1 : 0;
    $jarak += ($data1['course'] !== $data2['course']) ? 1 : 0;
    $jarak += ($data1['daytime'] !== $data2['daytime']) ? 1 : 0;
    $jarak += pow($data1['age'] - $data2['age'], 2);
    return sqrt($jarak);
}

// Menghitung centroid dari sebuah cluster
function hitung_centroid($cluster) {
    $centroid = array(
        'gender' => array('male' => 0, 'female' => 0),
        'course' => array('programming' => 0, 'design' => 0),
        'daytime' => array('morning' => 0, 'afternoon' => 0, 'evening' => 0),
        'age' => 0
    );
    $jumlah_data = count($cluster);
    foreach ($cluster as $data_point) {
        $centroid['gender'][$data_point['gender']]++;
        $centroid['course'][$data_point['course']]++;
        $centroid['daytime'][$data_point['daytime']]++;
        $centroid['age'] += $data_point['age'];
    }
    foreach ($centroid['gender'] as $gender => $jumlah) {
        $centroid['gender'][$gender] /= $jumlah_data;
    }
    foreach ($centroid['course'] as $course => $jumlah) {
$centroid['course'][$course] /= $jumlah_data;
}
foreach ($centroid['daytime'] as $daytime => $jumlah) {
$centroid['daytime'][$daytime] /= $jumlah_data;
}
$centroid['age'] /= $jumlah_data;
return $centroid;
}

// Inisialisasi centroid secara acak
function inisialisasi_centroid($data, $k) {
$centroid = array();
$indeks_data = array_rand($data, $k);
foreach ($indeks_data as $indeks) {
$centroid[] = $data[$indeks];
}
return $centroid;
}

// Menentukan cluster untuk setiap data
function tentukan_cluster($data, $centroid) {
$clusters = array();
foreach ($data as $data_point) {
$jarak_terpendek = INF;
$indeks_cluster_terdekat = null;
foreach ($centroid as $indeks_cluster => $centroid_point) {
$jarak = hitung_jarak($data_point, $centroid_point);
if ($jarak < $jarak_terpendek) {
$jarak_terpendek = $jarak;
$indeks_cluster_terdekat = $indeks_cluster;
}
}
$clusters[$indeks_cluster_terdekat][] = $data_point;
}
return $clusters;
}

// Menghitung nilai SSE (Sum of Squared Errors)
function hitung_sse($clusters, $centroid) {
$sse = 0;
foreach ($clusters as $indeks_cluster => $data_cluster) {
foreach ($data_cluster as $data_point) {
$jarak = hitung_jarak($data_point, $centroid[$indeks_cluster]);
$sse += pow($jarak, 2);
}
}
return $sse;
}

// K-means clustering
function kmeans($data, $k, $iterasi = 100) {
// Inisialisasi centroid
$centroid = inisialisasi_centroid($data, $k);
// Iterasi k-means
for ($i = 0; $i < $iterasi; $i++) {
// Tentukan cluster
$clusters = tentukan_cluster($data, $centroid);
// Hitung centroid baru
$centroid_baru = array();
foreach ($clusters as $indeks_cluster => $data_cluster) {
$centroid_baru[] = hitung_centroid($data_cluster);
}
// Periksa apakah centroid telah konvergen
if ($centroid == $centroid_baru) {
break;
}
$centroid = $centroid_baru;
}
// Hitung SSE
$sse = hitung_sse($clusters, $centroid);
return array('clusters' => $clusters, 'centroid' => $centroid, 'sse' => $sse);
}

// Jalankan k-means clustering
$hasil_kmeans = kmeans($data, $k);

// Tampilkan output berupa tabel
echo '<table border="1">';
echo '<thead><tr><th>No.</th><th>Gender</th><th>Course</th><th>Daytime</th><th>Age</th><th>Cluster</th></tr></thead>';
echo '<tbody>';
$no = 1;
foreach ($data as $indeks_data => $data_point) {
foreach ($hasil_kmeans['clusters'] as $indeks_cluster => $data_cluster) {
        if (in_array($data_point, $data_cluster)) {
            echo '<tr>';
            echo '<td>' . $no . '</td>';
            echo '<td>' . $data_point['gender'] . '</td>';
            echo '<td>' . $data_point['course'] . '</td>';
            echo '<td>' . $data_point['daytime'] . '</td>';
            echo '<td>' . $data_point['age'] . '</td>';
            echo '<td>' . $indeks_cluster . '</td>';
            echo '</tr>';
            $no++;
            break;
        }
    }
}
echo '</tbody></table>';

// Tampilkan output berupa grafik
echo '<h2>Visualisasi Hasil K-Means Clustering</h2>';
echo '<h3>Scatter Plot</h3>';
echo '<div id="scatter_plot" style="width: 800px; height: 600px;"></div>';
echo '<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>';
echo '<script>';
echo 'var data = [';
for ($i = 0; $i < $k; $i++) {
    echo '{';
    echo 'x: [';
    foreach ($hasil_kmeans['clusters'][$i] as $data_point) {
        echo $data_point['age'] . ',';
    }
    echo '],';
    echo 'y: [';
    foreach ($hasil_kmeans['clusters'][$i] as $data_point) {
        echo "'" . $data_point['daytime'] . "',";
    }
    echo '],';
    echo 'mode: "markers",';
    echo 'type: "scatter",';
    echo 'name: "Cluster ' . ($i + 1) . '",';
    echo 'marker: {';
    echo 'color: "' . $colors[$i] . '",';
    echo 'size: 10';
    echo '}';
    echo '},';
}
echo '];';
echo 'var layout = {';
echo 'title: "Scatter Plot of Age vs. Daytime",';
echo 'xaxis: {title: "Age"},';
echo 'yaxis: {title: "Daytime"},';
echo '};';
echo 'Plotly.newPlot("scatter_plot", data, layout);';
echo '</script>';

echo '<h3>Bar Chart</h3>';
echo '<div id="bar_chart" style="width: 800px; height: 600px;"></div>';
echo '<script>';
echo 'var data = [';
for ($i = 0; $i < $k; $i++) {
    echo '{';
    echo 'x: [';
    foreach ($hasil_kmeans['clusters'][$i] as $data_point) {
        echo "'" . $data_point['course'] . "',";
    }
    echo '],';
    echo 'y: [';
    foreach ($hasil_kmeans['clusters'][$i] as $data_point) {
        echo '1,';
    }
    echo '],';
    echo 'type: "bar",';
    echo 'name: "Cluster ' . ($i + 1) . '",';
    echo 'marker: {';
    echo 'color: "' . $colors[$i] . '"';
    echo '}';
    echo '},';
}
echo '];';
echo 'var layout = {';
echo 'title: "Bar Chart of Course by Cluster",';
echo 'xaxis: {title: "Course"},';
echo 'yaxis: {title: "Count"},';
echo 'barmode: "stack"';
echo '};';
echo 'Plotly.newPlot("bar_chart", data, layout);';
echo '</script>';

// Fungsi untuk menghasilkan warna secara acak
function random_color_part()
{
    return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
}

function random_color()
{
    return '#' . random_color_part() . random_color_part() . random_color_part();
}
?>