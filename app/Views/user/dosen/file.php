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

                <?php if (empty($files)) : ?>
                    <h5 class="h5 font-weight text-gray-800 d-flex justify-content-center">Tidak ada files</h5>
                    <a href="<?= base_url('pages') ?>">&larr; Back to home</a>
                <?php else : ?>
                    <!-- table -->
                    <div class="card shadow mb-4">
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
                                                    <a href="/files/<?= $f['store_file'] ?>"><?= $f['file'] ?></a>
                                                </td>
                                                <td><?= $f['uploaded_at'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- content end here -->

            </div>

        </div>

    </div>

</div>
<?= $this->endSection(); ?>