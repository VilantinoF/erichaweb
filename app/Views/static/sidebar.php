<?php

$db = \Config\Database::connect();

$role_id = session()->get('role');

$userModel = model('App\Models\UserModel');
$result = session()->get('uname');
$user = $userModel->where('uname', $result)->first();

$queryMenu = "SELECT `menu`.`id`, `tittle`
				FROM `menu` JOIN `user_access_menu`
				  ON `menu`.`id` = `user_access_menu`.`menu_id`
			   WHERE `user_access_menu`.`role_id` = $role_id
			ORDER BY `user_access_menu`.`menu_id` ASC
			";

$menu = $db->query($queryMenu)->getResultArray();

?>


<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
		<div class="sidebar-brand-icon">
			<i class="fas fa-user-alt"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Hai, <?= $user['uname']; ?></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-2">

	<!-- MENU -->
	<?php foreach ($menu as $m) : ?>
		<div class="sidebar-heading">
			<?= $m['tittle'] ?>
		</div>


		<!-- SubMenu -->

		<?php

		$menuId = $m['id'];
		$queryFolder = "SELECT * FROM `folder` WHERE `menu_id` = $menuId";

		$folder = $db->query($queryFolder)->getResultArray();

		?>

		<?php foreach ($folder as $f) : ?>

			<li class="nav-item">
				<a class="nav-link collapsed" href="<?= $f['url'] ?>" <?= ($f['url'] != null) ? '' : "data-toggle='collapse'"; ?> data-target="#<?= str_replace(' ', '', $f['tittle']) ?>" aria-expanded="true" aria-controls="<?= str_replace(' ', '', $f['tittle']) ?>">
					<i class="<?= $f['icon'] ?>"></i>
					<span><?= $f['tittle'] ?></span>
				</a>

				<?php

				$folderId = $f['id'];
				$querySubFolder = "SELECT * FROM `sub_folder` WHERE `folder_id` = $folderId";

				$subFolder = $db->query($querySubFolder)->getResultArray();

				?>

				<div id="<?= str_replace(' ', '', $f['tittle']) ?>" class="collapse">
					<div class="bg-gray-300 py-2 collapse-inner rounded">
						<?php foreach ($subFolder as $sf) : ?>

							<a class="collapse-item text-wrap" href="<?= base_url(($sf['url'] != null) ? $sf['url'] . $f['id'] . '/' . $sf['id'] : ''); ?>" <?= ($sf['url'] != null) ? '' : "data-toggle='collapse'"; ?> data-target="#<?= str_replace('/', '', str_replace(' ', '', $sf['tittle'])) ?>" aria-expanded="true" aria-controls="<?= str_replace('/', '', str_replace(' ', '', $sf['tittle'])) ?>"><?= $sf['tittle'] ?>
							</a>


							<?php

							$subFolderId = $sf['id'];
							$querySubSubFolder = "SELECT * FROM `sub_sub_folder` WHERE `sub_folder_id` = $subFolderId";

							$subSubFolder = $db->query($querySubSubFolder)->getResultArray();

							?>


							<div id="<?= str_replace('/', '', str_replace(' ', '', $sf['tittle'])) ?>" class="collapse bg-white rounded">
								<?php foreach ($subSubFolder as $ssf) : ?>
									<div class="py-0 my-0 collapse-inner rounded">
										<a class="collapse-item text-wrap" href="<?= base_url(($ssf['url'] != null) ? $ssf['url'] . '/' . $f['id'] . '/' . $sf['id'] . '/' . $ssf['id'] : ''); ?>"><?= $ssf['tittle'] ?></a>
									</div>
								<?php endforeach; ?>
							</div>

						<?php endforeach; ?>

					</div>

				</div>

			</li>

		<?php endforeach; ?>

		<!-- Divider -->
		<hr class="sidebar-divider my-2">


	<?php endforeach; ?>

	<li class="nav-item">
		<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
			<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
			<span>Logout</span></a>
	</li>

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
<!-- End of Sidebar -->