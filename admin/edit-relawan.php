<?php
require_once '../includes/session.php';
require_once '../db/connect.php';

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 'admin') {
        header("Location:../CariAktivitas.php");
        die;
    }
} else {
    header("Location: ../login.php");
};

if (isset($_GET['id'])) {
    $id_pengguna = $_GET['id'];

    // Fetch Data user
    $result = $user->getUserRelawanbyId($id_pengguna);
    if (!$result) {
        header("Location:relawan.php");
        die;
    }
} else {
    header("Location: relawan.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="favicon" sizes="16x16" href="../assets/favicon/favicon-16x16.ico" />
    <link rel="icon" type="favicon" sizes="48x48" href="../assets/favicon/favicon-48-48.ico" />

    <title>Edit Relawan | Relawan Kita</title>

    <!-- Custom fonts for this template -->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include("../includes/admin/sidebar.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include("../includes/admin/topbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Ubah Profile Relawan</h1>
                    <?php 
                    
                    if (isset($_GET['EditUser'])) {
                        if ($_GET['EditUser'] == 'failed') {
                            $message = 'Gagal untuk merubah profil akun, Cek kembali form anda';
                            include_once '../includes/errormessage.php';
                        }
                    }

                    ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary py-2">Detail Profile</h6>
                        </div>
                        <div class="card-body">
                            <form action="../functions/edit-user.php" method="post">
                                <!-- Email -->
                                <input type="hidden" name="id_pengguna" value="<?= $id_pengguna; ?>">
                                <div class="form-group mb-3  d-flex flex-column">
                                    <label for="nama" class="mb-1">Nama Lengkap *</label>
                                    <input required type="text" class="form-control" id="nama" name="nama" value="<?= $result['nama'] ?>">
                                </div>
                                <div class="form-group  mb-3 d-flex flex-column">
                                    <label for="nomor_telepon" class="mb-1">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?= $result['nomor_telepon'] ?>">
                                </div>
                                <div class="form-group  mb-3 d-flex flex-column">
                                    <label for="tanggal_lahir" class="mb-1">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $result['tanggal_lahir'] ?>">
                                </div>
                                <div class="formgroup  mb-3">
                                    <label class="mb-1">Jenis Kelamin *</label>
                                    <div class="container">
                                        <div class="form-check">
                                            <input required class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="Laki-laki" <?php if ($result['jenis_kelamin'] == 'Laki-laki') echo 'checked'; ?>>
                                            <label class="form-check-label" for="jenis_kelamin1">
                                                Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="Perempuan" <?php if ($result['jenis_kelamin'] == 'Perempuan') echo 'checked'; ?>>
                                            <label class="form-check-label" for="jenis_kelamin2">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3  d-flex flex-column">
                                    <label for="alamat" class="mb-1">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= $result['alamat']; ?></textarea>
                                </div>

                                <!-- Button Login -->
                                <div class="d-grid mb-3">
                                    <button type="submit" name="submit" class="btn btn-primary btn-block fw-bold">Update User</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include("../includes/admin/footer.php"); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>