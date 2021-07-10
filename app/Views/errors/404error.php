<?= $this->extend('static/default'); ?>

<?= $this->section('content'); ?>
<div id="wrapper">

    <?= $this->include('static/sidebar'); ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <?= $this->include('static/topbar') ?>

            <div class="container-fluid">

                <!-- 404 Error Text -->
                <div class="text-center">
                    <div class="error mx-auto" data-text="404">404</div>
                    <p class="lead text-gray-800 mb-5">Page Not Found</p>
                    <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
                    <a href="/pages">&larr; Back to Dashboard</a>
                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection(); ?>