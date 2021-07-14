

<?php require_once __SITE_PATH . '/view/_header.php'; ?>
<h1>Rezervacija prostorija na fakultetu</h1>
<form class="login" method="post" action="<?php echo __SITE_URL . '/index.php?rt=site'?>">
	<div id="wrapper">
		<button type="submit" name="log" value="login">Prijavi se</button>
		<br />
		<button type="submit" name="sign" value="login">Registriraj se</button>
		<br />
		<button type="submit" name="admin" value="admin">Prijavi se kao administrator</button>
		<br>
		<button type="submit" name="nolog" value="nolog">Prijavi se kao gost</button>
	</div>

	
</form>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>