<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<<<<<<< HEAD
<form class="login" method="post" action="<?php echo __SITE_URL . '/index.php?rt=login/korisnik'?>">
	<!--<div class="wrapper">-->
=======
<form class="login" method="post" action="<?php echo __SITE_URL . '/index.php?rt=user/login'?>">
	<div class="wrapper">
>>>>>>> e64e6ed62a7211c4bbfc166936da11398bba8d81
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
