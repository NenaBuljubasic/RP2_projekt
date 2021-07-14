<?php require_once __SITE_PATH . '/view/_header1.php'; ?>

<h1>Prijava administratora</h1>
<form class="login" method="post" action="<?php echo __SITE_URL . '/index.php?rt=user/administrator'?>">
	<div id="wrapper">
		Korisničko ime: <br>
		<input type="text" name="username" />
		<br />
		Lozinka: <br>
		<input type="password" name="password" />
		<br />
		<button type="submit" name="gumb" value="login">Prijavi se</button>
	</div>
</form>
	

<?php require_once __SITE_PATH . '/view/_footer.php'; 




?>