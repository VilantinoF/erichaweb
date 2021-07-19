<?= $this->extend('templates/default'); ?>

<?= $this->section('content'); ?>
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- sidebar -->
    <?= $this->include('templates/sidebar'); ?>
    <!-- endsidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?= $this->include('templates/topbar') ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h2 font-weight-bold text-gray-800 d-flex justify-content-center">Selamat Datang</h1>
                <h2 class="h4 mb-4 text-gray-800 d-flex justify-content-center">Sistem Kearsipan Bidang Akademik Politeknik Negeri Semarang</h2>

                <form action="" method="POST" class="d-flex justify-content-center navbar-search">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control bg-light border-1 small" placeholder="Cari file..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>