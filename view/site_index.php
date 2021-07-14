

<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<form class="login" method="post" action="<?php echo __SITE_URL . '/index.php?rt=site'?>">
	<div id="wrapper">
		<button type="submit" name="log" value="login">Log in</button>
		<br />
		<button type="submit" name="sign" value="login">Sign up</button>
		<br />
		<button type="submit" name="admin" value="admin">Log in as an administrator</button>
		<br>
		<button type="submit" name="nolog" value="nolog">Log in as guest</button>
	</div>

	
</form>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>