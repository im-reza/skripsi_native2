<?php     
include 'connections/connection_db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style_login.css">
    <title>SKRIPSI</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top: 60px">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['no_login'])) {
                            echo "".$_SESSION['no_login']."";
                            session_destroy();
                        }
                        unset($_SESSION['no_login']);
                        ?>
                        <form method="POST" action="">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Username</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="username" required="" placeholder="Masukkan Username">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="pass" required="" placeholder="Masukkan Password">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 

    if (isset($_POST['submit'])) {
        # code...
        $nm1=mysqli_real_escape_string($con, $_POST['username']);
        $ps1=md5($_POST['pass']);
        $login=mysqli_query($con,"select * from user where username='$nm1' and password='$ps1' ");
        $cek=mysqli_num_rows($login);
        if ($cek>0) {
            $data=mysqli_fetch_assoc($login);
            if ($data['jabatan']=="".$data['jabatan']."") {
                $_SESSION['username']=$nm1;
                $_SESSION['nama']="".$data['nama']."";
                $_SESSION['jabatan']="".$data['jabatan']."";
                header("location:admin/index.php");
            }              
        }else{
            $_SESSION['no_login']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Username dan Password salah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            return false;
        }
        return true;
    }
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>

