<?php
include '../../connections/connection_db.php';
$no = $_GET['no']; // Menerima kiriman data dari inputan pengguna

$sql=mysqli_query($con,"SELECT * FROM surat_masuk WHERE no_surat='$no'"); // query sql untuk menampilkan 

while ($row = mysqli_fetch_array($sql)) {
    $data[] = $row['no_surat'];
    $data[]=$row['perihal'];
}
//Nilainya disimpan dalam bentuk json
echo json_encode($data);
?>