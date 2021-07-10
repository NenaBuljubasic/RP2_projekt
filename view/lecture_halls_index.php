<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<form class="login" method="post" action="<?php echo __SITE_URL . '/index.php?rt=login/korisnik'?>"><!--  '/index.php?rt=user/action'    --> 
	<label for="choose">
     Izaberite zeljenu opciju:
	<select name="red">
        <option value="" selected>Pregled rezerviranih ucionica</option>
        <option value="">Rezerviraj novu ucionicu</option>
		<option value="">Obrisi rezervaciju</option>
    </select>
    </label>
<button>Kreni</button>
</form>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
