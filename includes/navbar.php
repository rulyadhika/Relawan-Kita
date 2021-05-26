<nav class="navbar sticky-top navbar-expand-md navbar-dark scrolling-navbar bg-color-red">
    <div class="container-md">
        <a class="navbar-brand mb-0 h1" href="index.php">Relawan Kita</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sticky-nav"
            aria-controls="sticky-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse pt-sm-2 pt-md-0 justify-content-between" id="sticky-nav">
            <ul class="navbar-nav">
                <!-- sudah masuk ? -->
                <?php if (isset($_SESSION['role'])) : ?>
                <!-- jadi admin ? -->
                <?php if ($_SESSION['role'] == 'admin') : ?>
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" href="admin-User.php">Manajemen User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" href="Admin-Organisasi.php">Manajemen Organisasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" href="admin-Acara.php">Manajemen Acara</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" href="admin-JenisAcara.php">Manajemen Jenis Acara</a>
                </li>
                <?php elseif ($_SESSION['role'] == 'organisasi') : ?>
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" href="admin-Acara.php">Manajemen Acara</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active px-1 mx-1" href="CariAktivitas.php">Cari Aktivitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" href="TentangKami.php">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" href="index.php">Home</a>
                </li>
                <?php else : ?>
                <li class="nav-item ">
                    <a class="nav-link active px-1 mx-1" href="CariAktivitas.php">Cari Aktivitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" href="TentangKami.php">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" href="index.php">Home</a>
                </li>
                <?php endif ?>
                <!-- Kalo belum login dan selain admin -->
                <?php else : ?>
                <li class="nav-item ">
                    <a class="nav-link active px-1 mx-1" href="CariAktivitas.php">Cari Aktivitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" href="TentangKami.php">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" href="index.php">Home</a>
                </li>
                <?php endif ?>
                <!-- Sudah login? -->
                <?php if (isset($_SESSION['nama'])) : ?>
            </ul>
            <ul class=" navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white px-1 mx-1" href="#" id="navbarDarkDropdownMenuLink"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['nama']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <?php if ($_SESSION['role'] != 'admin') : ?>
                        <li><a class="dropdown-item" href="<?php if($_SESSION['role'] == 'volunteer') echo 'EditProfil-Relawan.php'; else echo 'EditProfil-Organisasi.php';  ?>">Setting Akun</a></li>
                        <?php endif ?>
                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Kalau belum login -->
            <?php else : ?>
            </ul>
            <ul class=" navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" href="Login.php">Masuk</a>
                </li>
                <li class="nav-item dropdown border border-white mx-2" id="BuatAkun">
                    <a class="nav-link dropdown-toggle px-1 mx-1" href="#" id="navbarDarkDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Buat Akun!
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark " aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="BuatAkun-Relawan.php">Akun Relawan</a></li>
                        <li><a class="dropdown-item" href="BuatAkun-Organisasi.php">Akun Organisasi</a></li>
                    </ul>
                </li>
            </ul>
            <?php endif ?>
        </div>
    </div>
</nav>