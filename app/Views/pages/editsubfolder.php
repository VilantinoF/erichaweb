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

                <form action="<?= base_url('pages/editsubfolder') ?>" method="POST">
                    <input type="hidden" name="id" value="<?= $subFolderById['id'] ?>">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nama Sub Folder" name="tittle" value="<?= $subFolderById['tittle']; ?>">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="URL" name="url" value="<?= $subFolderById['url']; ?>">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="folderId">
                            <?php foreach ($folder as $f) : ?>
                                <?php if (!$f['url']) : ?>
                                    <option value="<?= $f['id'] ?>" <?= ($subFolderById['folder_id'] == $f['id']) ? 'selected' : ''; ?>><?= $f['tittle'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <a href="<?= base_url('pages/managesubfolder') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Edit</button>

                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>