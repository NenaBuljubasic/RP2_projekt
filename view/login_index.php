<?php require_once __SITE_PATH . '/view/_header.php'; ?>



=======
<form class="login" method="post" action="<?php echo __SITE_URL . '/index.php?rt=user/login'?>">
	<div class="wrapper">
	Username: 
	<input type="text" name="username" />
	<br />
	Password:
	<input type="password" name="password" />
	<br />
	<button type="submit" name="gumb" value="login">Log in</button>
	</form>
	<!--</div>-->

<?php require_once __SITE_PATH . '/view/_footer.php'; 




?>
