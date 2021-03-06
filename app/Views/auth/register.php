<?= $this->extend('auth/templates/auth_default'); ?>

<?= $this->section('content'); ?>

<div class="container">

	<div class="card o-hidden border-0 shadow-lg my-5 col-xl-6 col-lg-5 col-md-8 mx-auto">
		<div class="card-body p-0">
			<!-- Nested Row within Card Body -->
			<div class="row">
				<div class="col-lg">
					<div class="p-5">
						<div class="text-center">
							<h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
						</div>
						<form class="user" action="/auth/saveaccount" method="POST">
							<?= csrf_field(); ?>
							<div class="form-group">
								<input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= old('name'); ?>">
								<?= $validation->getError('name'); ?>
							</div>
							<div class="form-group">
								<input type="text" class="form-control form-control-user" id="uname" name="uname" placeholder="Username" value="<?= old('uname'); ?>">
								<?= $validation->getError('uname'); ?>
							</div>
							<div class="form-group">
								<select class="form-select form-control" name="role">
									<option selected>--Jabatan--</option>
									<option value="2">Mahasiswa</option>
									<option value="3">Dosen</option>
								</select>
							</div>
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
									<?= $validation->getError('password1'); ?>
								</div>
								<div class="col-sm-6">
									<input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-user btn-block">
								Register Account
							</button>
						</form>
						<hr>
						<div class="text-center">
							<a class="small" href="<?= base_url('auth') ?>">Already have an account? Login!</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<?= $this->endSection(); ?>