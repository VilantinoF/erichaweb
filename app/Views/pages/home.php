<?= $this->extend('static/default'); ?>

<?= $this->section('content'); ?>
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- sidebar -->
    <?= $this->include('static/sidebar'); ?>
    <!-- endsidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?= $this->include('static/topbar') ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>