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
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Folder</th>
                            <th scope="col">URL</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($subFolder as $sf) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= $sf['tittle']; ?></td>
                                <td><?= $sf['url']; ?></td>
                                <td><i class="<?= $sf['icon']; ?>"></i></td>
                                <td>
                                    <a class="badge badge-danger" data-bs-toggle="modal" data-bs-target="#deleteFolder" href="#">Hapus</a>
                                    <a class="badge badge-success" href="#">Edit</a>
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

                <form action="addmenu" method="POST">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="namaFolder" placeholder="Nama Folder" name="namaFolder">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="url" placeholder="Url" name="url">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="menuId">
                            <?php foreach ($folder as $f) : ?>
                                <option value="<?= $f['id'] ?>"><?= $f['tittle'] ?></option>
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

<!-- modal delete folder -->
<div class="modal fade" id="deleteFolder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                Yakin akan menghapus folder <?= $sf['tittle']; ?>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="deletemenu/<?= $sf['id']; ?>" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>