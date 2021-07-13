<?= $this->extend('static/auth_default'); ?>

<?= $this->section('content'); ?>

<div class="container">

	<div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
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
							<p>Already have an account? <a class="small" href="/auth">Login!</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<?= $this->endSection(); ?>