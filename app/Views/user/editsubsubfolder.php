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

                <form action="<?= base_url('pages/editsubsubfolder') ?>" method="POST">
                    <input type="hidden" name="id" value="<?= $subSubFolderById['id'] ?>">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nama Sub Folder" name="tittle" value="<?= $subSubFolderById['tittle']; ?>">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="URL" name="url" value="<?= $subSubFolderById['url']; ?>">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="subFolderId">
                            <?php foreach ($subFolder as $sf) : ?>

                                <?php
                                $db = \Config\Database::connect();
                                $folderId = $sf['folder_id'];


                                $query = "SELECT `folder`.*
				                        FROM `sub_folder` JOIN `folder`
				                        ON `folder`.`id` = $folderId
			                            ORDER BY `sub_folder`.`id` ASC
			                            ";

                                $result = $db->query($query)->getRowArray();

                                ?>

                                <?php if (!$result['url']) : ?>
                                    <option value="<?= $sf['id'] ?>" <?= ($subSubFolderById['sub_folder_id'] == $sf['id']) ? 'selected' : ''; ?>><?= $result['tittle'] . ' / ' . $sf['tittle'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <a href="<?= base_url('pages/managesubsubfolder') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Edit</button>

                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>