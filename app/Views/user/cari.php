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

                <h1 class="h2 font-weight-bold text-gray-800 d-flex justify-content-center">Hasil pencarian "<?= $keyword ?>"</h1>

                <!-- table -->
                <?php if (empty($hasilCari)) : ?>
                    <h5 class="h5 font-weight text-gray-800 d-flex justify-content-center">Hasil pencarian untuk "<?= $keyword ?>" tidak ditemukan</h5>
                    <a href="<?= base_url('pages') ?>">&larr; Back to home</a>
                <?php else : ?>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama file</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($hasilCari as $hs) : ?>
                                            <?php

                                            $db = \Config\Database::connect();

                                            // $subSubSubFolderId = $sssf['sub_sub_folder_id'];
                                            $query = "SELECT `folder`.`tittle` as f, `sub_folder`.`tittle` as `sf`, `sub_sub_folder`.`tittle` as `ssf`, `sub_sub_sub_folder`.`tittle` as `sssf`
                                                            FROM `files`
                                                            JOIN `folder` ON `folder`.`id` = `folder_id`
                                                            JOIN `sub_folder` ON `sub_folder`.`id` = `sub_folder_id`
                                                            JOIN `sub_sub_folder` ON `sub_sub_folder`.`id` = `sub_sub_folder_id`
                                                            JOIN `sub_sub_sub_folder` ON `sub_sub_sub_folder`.`id` = `sub_sub_sub_folder_id`
                                                            ";

                                            $result = $db->query($query)->getRowArray();

                                            ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td>
                                                    <?= $hs['file'] ?>
                                                </td>
                                                <td><?= $result['f'] . ' / ' . $result['sf'] . ' / ' . $result['ssf'] . ' / ' . $result['sssf'] ?></td>
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