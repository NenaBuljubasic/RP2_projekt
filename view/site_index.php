

<?php require_once __SITE_PATH . '/view/_header1.php'; ?>
<h1>Rezervacija prostorija na fakultetu</h1>
<form class="login" method="post" action="<?php echo __SITE_URL . '/index.php?rt=site'?>">
	<div id="wrapper">
		<button type="submit" name="log" value="login"  class="pocetna1">Prijavi se</button>
		<button type="submit" name="sign" value="login" class="pocetna2">Registriraj se</button>
	</div>
		<br />
	<div id="wrapper">
		<button type="submit" name="admin" value="admin" class="pocetna1">Prijavi se kao administrator</button>
		<button type="submit" name="nolog" value="nolog" class="pocetna2">Prijavi se kao gost</button>
	</div>

	
</form>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>