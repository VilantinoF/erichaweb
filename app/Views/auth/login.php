<?= $this->extend('static/auth_default'); ?>

<?= $this->section('content'); ?>

<div class="container">

	<!-- Outer Row -->
	<div class="row justify-content-center">

		<div class="col-7">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Please Login!</h1>
								</div>
								<?php if (session()->getFlashdata('pesan')) : ?>
									<?= session()->getFlashdata('pesan'); ?>
								<?php endif; ?>
								<form class="user" action="/auth/login" method="POST">
									<?= csrf_field(); ?>
									<div class="form-group">
										<input type="text" class="form-control form-control-user" id="uname" name="uname" placeholder="Enter Username">
										<?= $validation->getError('uname'); ?>
									</div>
									<div class="form-group">
										<input type="password" class="form-control form-control-user" id="password1" name="password" placeholder="Password">
										<?= $validation->getError('password'); ?>
									</div>
									<button type="submit" name="login" class="btn btn-primary btn-user btn-block">
										Login
									</button>
								</form>
								<hr>
								<div class="text-center">
									<a class="small" href="/auth/register">Create an Account!</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>
<?= $this->endSection(); ?>