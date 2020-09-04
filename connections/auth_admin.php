<?php 
if ($_SESSION['username']!='admin') {
  echo "<script>window.location.href='404.php'</script>";
} else {
    # code...
}
 ?>