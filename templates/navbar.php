<nav>
	<div>
		<a href="index.php">Home</a>
		<?php if (isLoggedIn()): ?>
			 | <a href="users.php">Users</a>
			 | <a href="#">Members</a>
			 | <a href="#">Products</a>
			 | <a href="#">Settings</a>
		<?php endif ?>
	</div>
	<div>
		<?php if (isLoggedIn()): ?>
			<span>Hello <?php echo htmlEscape(getAuthUser()) ?> | 
			<a href="logout.php">Logout</a>
		<?php else: ?>
			<a href="install.php">Install</a> | 
			<a href="login.php">Login</a>
		<?php endif ?>
	</div>
</nav>
