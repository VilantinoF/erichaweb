<?= $this->extend('static/default'); ?>

<?= $this->section('content'); ?>
<div id="wrapper">

    <!-- sidebar -->
    <?= $this->include('static/sidebar'); ?>
    <!-- endsidebar -->

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?= $this->include('static/topbar') ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">


                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahFolder">
                    Tambah Folder
                </button>

                <?php if (session()->getFlashdata('pesan')) : ?>
                    <?= session()->getFlashdata('pesan'); ?>
                <?php endif; ?>


                <!-- table -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Sub Folder</th>
                            <th scope="col">Parent Folder</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1 ?>
                        <?php foreach ($subFolder as $sf) : ?>
                            <?php

                            $db = \Config\Database::connect();

                            $subFolderId = $sf['sub_menu_id'];

                            $query = "SELECT `sub_menu`.`tittle`
				                        FROM `sub_sub_menu` JOIN `sub_menu`
				                        ON `sub_menu`.`id` = $subFolderId
			                            ORDER BY `sub_menu`.`id` ASC
			                            ";

                            $menu = $db->query($query)->getRowArray();
                            ?>

                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $sf['tittle']; ?></td>
                                <td><?= $menu['tittle']; ?></td>
                                <td>
                                    <a class="badge badge-danger" href="<?= base_url('pages/deletesubfolder/' . $sf['id']) ?>">Hapus</a>
                                    <a class="badge badge-warning" href="<?= base_url('pages/editsubfolder/' . $sf['id']) ?>">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

        </div>
        <!-- End of Main Content -->

    </div>

</div>

<!-- modal tambah folder -->
<div class="modal fade" id="tambahFolder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Sub Folder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url('pages/addSubFolder') ?>" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="namaFolder" placeholder="Nama Folder" name="namaFolder">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="folderId">
                            <?php foreach ($folder as $f) : ?>
                                <?php if (!$f['url']) : ?>
                                    <option value="<?= $f['id'] ?>"><?= ($f['url']) ?: $f['tittle']  ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>