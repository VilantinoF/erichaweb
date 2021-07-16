<?= $this->extend('templates/default'); ?>

<?= $this->section('content'); ?>
<div id="wrapper">

    <!-- sidebar -->
    <?= $this->include('templates/sidebar'); ?>
    <!-- endsidebar -->

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?= $this->include('templates/topbar') ?>

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
                            <th scope="col">Nama Sub Sub Folder</th>
                            <th scope="col">URL</th>
                            <th scope="col">Parent Folder</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1 ?>
                        <?php foreach ($subSubFolder as $ssf) : ?>
                            <?php

                            $db = \Config\Database::connect();

                            $subFolderId = $ssf['sub_folder_id'];


                            $query = "SELECT `sub_folder`.`tittle`, `folder`.`tittle` as `foldert`
				                        FROM `sub_sub_folder` JOIN `sub_folder`
				                        ON `sub_folder`.`id` = $subFolderId
                                        JOIN `folder` ON `sub_folder`.`folder_id` = `folder`.`id`
			                            ORDER BY `sub_folder`.`id` ASC
			                            ";

                            $result = $db->query($query)->getRowArray();
                            // dd($result);
                            ?>



                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $ssf['tittle']; ?></td>
                                <td><?= $ssf['url']; ?></td>
                                <td><?= $result['foldert'] . ' / ' . $result['tittle']; ?></td>
                                <td>
                                    <a class="badge badge-danger" href="<?= base_url('pages/deletesubsubfolder/' . $ssf['id']) ?>">Hapus</a>
                                    <a class="badge badge-warning" href="<?= base_url('pages/editsubsubfolder/' . $ssf['id']) ?>">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Pagination -->

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
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Sub Sub Folder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url('pages/addSubSubFolder') ?>" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nama Sub Sub Folder" name="namaSubSubFolder">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="URL" name="url">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="subFolderId">
                            <?php foreach ($subFolder as $sf) : ?>

                                <?php

                                $folderId = $sf['folder_id'];


                                $query = "SELECT `folder`.`tittle`, `folder`.`url`
				                        FROM `sub_folder` JOIN `folder`
				                        ON `folder`.`id` = $folderId
			                            ORDER BY `sub_folder`.`id` ASC
			                            ";

                                $result = $db->query($query)->getRowArray();

                                ?>

                                <?php if (!$result['url']) : ?>
                                    <option value="<?= $sf['id'] ?>"><?= $result['tittle'] . ' / ' . $sf['tittle'] ?></option>
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