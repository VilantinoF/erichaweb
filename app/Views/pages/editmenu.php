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

                <form action="<?= base_url('pages/editmenu') ?>" method="POST">
                    <input type="hidden" name="id" value="<?= $folderbyid['id'] ?>">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nama Folder" name="namaFolder" value="<?= $folderbyid['tittle']; ?>">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Url" name="url" value="<?= $folderbyid['url']; ?>">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Icon" name="icon" value="<?= $folderbyid['icon']; ?>">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="menuId">
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id'] ?>" <?= ($folderbyid['menu_id'] == $m['id']) ? 'selected' : ''; ?>><?= $m['tittle'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <a href="<?= base_url('pages/managemenu') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Edit</button>

                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>