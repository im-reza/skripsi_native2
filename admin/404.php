<?php 
session_start();
if ($_SESSION['username']=='kabag') {
	include_once '../assets/header_kabag.php';
} else {
	include_once '../assets/header.php';
}
include_once '../assets/sidebar.php';
?>
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">

			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active">404</li>
				</ol>
			</div><!-- /.col -->
		</div>
	</div><!-- /.container-fluid -->
</div>

<section class="content">
	<div class="error-page">
		<h2 class="headline text-warning"> 404</h2>

		<div class="error-content">
			<h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

			<p>
				We could not find the page you were looking for.
				Meanwhile, you may <a href="../../index.html">return to dashboard</a> or try using the search form.
			</p>
		</div>
		<!-- /.error-content -->
	</div>
	<!-- /.error-page -->
</section>





<?php 
include_once '../assets/footer.php';  
?>
