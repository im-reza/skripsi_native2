<?php
include '../../connections/connection_db.php';
$searchTerm = $_GET['term']; // Menerima kiriman data dari inputan pengguna

$sql=mysqli_query($con,"SELECT * FROM surat_masuk WHERE no_surat LIKE '%".$searchTerm."%' ORDER BY id_sm ASC"); // query sql untuk menampilkan 

while ($row = mysqli_fetch_array($sql)) {
    $data[] = $row['no_surat'];
}
//Nilainya disimpan dalam bentuk json
echo json_encode($data);
?>