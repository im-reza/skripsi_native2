<?php 
include 'connections/connection_db.php'; 
session_destroy();
header("location:index.php");
?>