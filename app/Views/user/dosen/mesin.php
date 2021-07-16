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

                <!-- content start here -->

                <?php if (session()->getFlashdata('pesan')) : ?>
                    <?= session()->getFlashdata('pesan'); ?>
                <?php endif; ?>


                <!-- table -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Prodi</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama file</th>
                                        <th>Uploaded at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($files as $f) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <a href="<?= base_url('Mesin/downloadfile') . '/' . $f['id'] ?>"><?= $f['file'] ?></a>
                                            </td>
                                            <td><?= $f['uploaded_at'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- content end here -->

            </div>

        </div>

    </div>

</div>


<?= $this->endSection(); ?>