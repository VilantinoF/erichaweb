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
		$querySubMenu = "SELECT * FROM `sub_menu` WHERE `menu_id` = $menuId";

		$subMenu = $db->query($querySubMenu)->getResultArray();

		?>

		<?php foreach ($subMenu as $sm) : ?>

			<li class="nav-item">
				<a class="nav-link collapsed" href="<?= $sm['url'] ?>" <?= ($sm['url'] != null) ? '' : "data-toggle='collapse'"; ?> data-target="#<?= str_replace(' ', '', $sm['tittle']) ?>" aria-expanded="true" aria-controls="<?= str_replace(' ', '', $sm['tittle']) ?>">
					<i class="<?= $sm['icon'] ?>"></i>
					<span><?= $sm['tittle'] ?></span>
				</a>

				<?php

				$subMenuId = $sm['id'];
				$querysubSubMenu = "SELECT * FROM `sub_sub_menu` WHERE `sub_menu_id` = $subMenuId";

				$subSubMenu = $db->query($querysubSubMenu)->getResultArray();

				?>

				<div id="<?= str_replace(' ', '', $sm['tittle']) ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<?php foreach ($subSubMenu as $ssb) : ?>
							<a class="collapse-item text-wrap" href="#"><?= $ssb['tittle'] ?>
							</a>
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