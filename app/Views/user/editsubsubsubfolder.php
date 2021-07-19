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

                <form action="<?= base_url('pages/editsubsubsubfolder') ?>" method="POST">
                    <input type="hidden" name="id" value="<?= $subSubSubFolderById['id'] ?>">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nama Sub Sub Folder" name="tittle" value="<?= $subSubSubFolderById['tittle']; ?>">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="URL" name="url" value="<?= $subSubSubFolderById['url']; ?>">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="subSubFolderId">
                            <?php foreach ($subSubFolder as $ssf) : ?>

                                <?php
                                $db = \Config\Database::connect();
                                $subFolderId = $ssf['sub_folder_id'];
                                $query = "SELECT `folder`.`tittle` as f, `folder`.`url`, `sub_folder`.`tittle` as `sf`
                                FROM `sub_sub_folder` JOIN `sub_folder`
                                ON `sub_folder`.`id` = $subFolderId
                                JOIN `folder` ON `folder`.`id` = `sub_folder`.`folder_id`
                                ORDER BY `sub_folder`.`id` ASC
			                            ";

                                $result = $db->query($query)->getRowArray();
                                // d($ssf);

                                ?>

                                <?php if (!$result['url']) : ?>
                                    <option value="<?= $ssf['id'] ?>" <?= ($subSubSubFolderById['sub_sub_folder_id'] == $ssf['id']) ? 'selected' : ''; ?>><?= $result['f'] . ' / ' . $result['sf'] . ' / ' . $ssf['tittle'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <a href="<?= base_url('pages/managesubsubsubfolder') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Edit</button>

                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>