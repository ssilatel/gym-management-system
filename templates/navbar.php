<nav class="navbar navbar-expand-lg bg-body-tertiary">
	<div class="container-fluid">
		<a class="navbar-brand" href="index.php">Home</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-lable="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<?php if (isLoggedIn()): ?>
					<li class="nav-item">
						 <a class="nav-link active" aria-current="page" href="employees.php">Employees</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link active" aria-current="page" href="members.php">Members</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link active" aria-current="page" href="products.php">Products</a>
					</li>
				<?php endif ?>
			</ul>
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Settings
					</a>
					<?php if (isLoggedIn()): ?>
						<ul class="dropdown-menu">
							<div class="d-flex justify-content-center align-items-center">
								<span class="me-2"><?php echo htmlEscape(getAuthUser()) ?></span>
							</div>
							<li><hr class="dropdown-divider"</li>
							<li><a class="dropdown-item" href="logout.php">Logout</a></li>
						</ul>
					<?php else: ?>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="install.php">Install</a></li>
							<li><a class="dropdown-item" href="login.php">Login</a></li>
						</ul>
					<?php endif ?>
				</li>
			</ul>
		</div>
	</div>
</nav>
