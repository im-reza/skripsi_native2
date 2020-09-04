<?php

include '../../connections/connection_db.php';

$data=array();
$query =mysqli_query($con," select * from acara inner join surat_masuk on acara.no_surat=surat_masuk.no_surat order by acara.no_surat");


while ($d=mysqli_fetch_array($query)) {
 $data[]=array(
 	'id'=>$d['no_surat'],
 	'title'=>$d['perihal'],
 	'start'=>$d['start_event'],
 	'end'=>$d['end_event'],
 	'color'=> 'green',
 	'description' => $d['perihal'],
 	'url'=> '../file/'.$d['file'].''
 );
}
echo json_encode($data);


?>