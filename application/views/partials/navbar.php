<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
		<div class="navbar-brand">V88 Merchandise</div>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>




		<div class="collapse navbar-collapse" id="navbarText">
			<?php if ($is_logged_in) : ?>
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">


				<?php if ($role == 0) : ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('dashboard') ?>">Dashboard</a>
                </li>
            <?php elseif ($role == 1) : ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('dashboard/admin') ?>">Dashboard</a>
                </li>
            <?php endif; ?>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="<?= base_url('profile') ?>">Profile</a>
					</li>
				</ul>

				<span class="navbar-text">
					<div class="d-flex align-items-center">
						<div class="dropdown">
							<a class="dropdown-toggle text-decoration-none" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<?= $user_data['first_name'] ?? '' ?> <?= $user_data['last_name'] ?? '' ?>
							</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
								<li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a></li>
								<li><a class="dropdown-item" href="<?= base_url('logout') ?>">Log Out</a></li>
							</ul>
						</div>
					</div>
				</span>
			<?php else : ?>
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a href="<?= base_url('login') ?>" class="nav-link">Login</a>
					</li>
				</ul>
			<?php endif; ?>
		</div>




	</div>
</nav>
