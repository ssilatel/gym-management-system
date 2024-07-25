<nav>
	<div>
		<a href="index.php">Home</a>
		<?php if (isLoggedIn()): ?>
			 | <a href="employees.php">Employees</a>
			 | <a href="members.php">Members</a>
			 | <a href="#">Products</a>
			 | <a href="#">Settings</a>
		<?php endif ?>
	</div>
	<div>
		<?php if (isLoggedIn()): ?>
			<span>Hello <?php echo htmlEscape(getAuthUser()) ?> | 
			<a href="install.php">Install</a> | 
			<a href="logout.php">Logout</a>
		<?php else: ?>
			<a href="install.php">Install</a> | 
			<a href="login.php">Login</a>
		<?php endif ?>
	</div>
</nav>
