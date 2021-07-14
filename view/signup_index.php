<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<h1>Registracija</h1>
<form class="login" method="post" action="<?php echo __SITE_URL . '/index.php?rt=user/signup'?>">
	<div id="wrapper">
		Korisničko ime: 
		<input type="text" name="username" />
		<br />
		Lozinka:
		<input type="password" name="password" />
		<br />
		E-mail:
		<input type="email" name="email">
		<br />
		<button type="submit" name="gumb" value="login">Registriraj se</button>
	</div>
</form>
		



<?php require_once __SITE_PATH . '/view/_footer.php'; ?>