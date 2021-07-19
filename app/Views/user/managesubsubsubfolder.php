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
                    Tambah Sub Sub Sub Folder
                </button>

                <?php if (session()->getFlashdata('pesan')) : ?>
                    <?= session()->getFlashdata('pesan'); ?>
                <?php endif; ?>

                <?= $pager->links('subsubsubfolder', 'erichaweb') ?>
                <!-- table -->
                <table class="table table-hover table-responsive{-sm|-md|-lg|-xl|-xxl}">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Sub Sub Sub Folder</th>
                            <th scope="col">URL</th>
                            <th scope="col">Parent Folder</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 + (7 * ($page_indexing - 1)) ?>
                        <?php foreach ($subSubSubFolder as $sssf) : ?>

                            <?php

                            $db = \Config\Database::connect();

                            $subSubSubFolderId = $sssf['sub_sub_folder_id'];


                            $query = "SELECT `folder`.`tittle` as f, `folder`.`url`, `sub_folder`.`tittle` as `sf`, `sub_sub_folder`.`tittle` as `ssf`
                            FROM `sub_sub_sub_folder` JOIN `sub_sub_folder`
                            ON `sub_sub_folder`.`id` = $subSubSubFolderId
                            JOIN `sub_folder` ON `sub_folder`.`id` = `sub_sub_folder`.`sub_folder_id`
                            JOIN `folder` ON `folder`.`id` = `sub_folder`.`folder_id`
                            ORDER BY `sub_folder`.`id` ASC
			                            ";

                            $result = $db->query($query)->getRowArray();

                            ?>

                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $sssf['tittle']; ?></td>
                                <td><?= $sssf['url']; ?></td>
                                <td class="text-wrap"><?= $result['f'] . ' / ' . $result['sf'] . ' / ' . $result['ssf'] ?></td>
                                <td>
                                    <a class="badge badge-danger" href="<?= base_url('pages/deletesubsubsubfolder/' . $sssf['id']) ?>">Hapus</a>
                                    <a class="badge badge-warning" href="<?= base_url('pages/editsubsubsubfolder/' . $sssf['id']) ?>">Edit</a>
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
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Sub Sub Sub Folder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nama Sub Sub Sub Folder" name="tittle">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Url" name="url">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="subSubFolderId">

                            <?php foreach ($subSubFolder as $ssf) : ?>
                                <?php
                                $subFolderId = $ssf['sub_folder_id'];
                                $query = "SELECT `folder`.`tittle` as f, `folder`.`url`, `sub_folder`.`tittle` as `sf`
                                FROM `sub_sub_folder` JOIN `sub_folder`
                                ON `sub_folder`.`id` = $subFolderId
                                JOIN `folder` ON `folder`.`id` = `sub_folder`.`folder_id`
                                ORDER BY `sub_folder`.`id` ASC
			                            ";

                                $result = $db->query($query)->getRowArray();
                                // d($result);

                                ?>

                                <option value="<?= $ssf['id'] ?>"><?= $result['f'] . ' / ' . $result['sf'] . ' / ' . $ssf['tittle'] ?></option>
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