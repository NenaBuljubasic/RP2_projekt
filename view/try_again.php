<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<div id="failure">Neuspješna prijava</div>

<form action="<?php echo __SITE_URL . '/index.php?rt=user'?>"  method="POST">
    <label for="">Za ponovni pokusaj stisnuti gumb</label>
    <input type="submit" value="Ponovni pokusaj"/>
</form>









<?php require_once __SITE_PATH . '/view/_footer.php'; ?>