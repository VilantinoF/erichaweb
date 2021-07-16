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

                <!-- content start here -->

                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahFile">
                    Tambah File
                </button>

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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($files as $f) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <a href="<?= base_url('Akuntansi/downloadfile') . '/' . $f['id'] ?>"><?= $f['file'] ?></a>
                                            </td>
                                            <td><?= $f['uploaded_at'] ?></td>
                                            <td>
                                                <a href="<?= base_url('Akuntansi/deleteFile' . '/' . $f['id']) ?>">Delete</a>
                                            </td>
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

<!-- modal tambah file -->
<div class="modal fade" id="tambahFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url('Akuntansi/addFile') ?>" method="POST" enctype="multipart/form-data">
                    <?php
                    $parsing = explode('/', uri_string());
                    // dd($parsing);
                    if (!empty($parsing[1]) and !empty($parsing[2]) and !empty($parsing[3])) {
                        $folderId = $parsing[1];
                        $subFolderId = $parsing[2];
                        $subSubFolderId = $parsing[3];
                    } elseif (!empty($parsing[1]) and !empty($parsing[2])) {
                        $folderId = $parsing[1];
                        $subFolderId = $parsing[2];
                    } else {
                        $folderId = $parsing[1];
                    }
                    ?>
                    <input type="hidden" value="<?= (!empty($subSubFolderId)) ? $subSubFolderId : null ?>" name="subSubFolderId">
                    <input type="hidden" value="<?= (!empty($subFolderId)) ? $subFolderId : null ?>" name="subFolderId">
                    <input type="hidden" value="<?= (!empty($folderId)) ? $folderId : null ?>" name="folderId">
                    <div class="mb-3">
                        <input class="form-control" type="file" name="file">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>