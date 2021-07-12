<?php require_once __SITE_PATH . '/view/_header.php'; ?>


<form class="login" method="post" action="<?php echo __SITE_URL . '/index.php?rt=user/signup'?>">
	<div class="wrapper">
	Username: 
	<input type="text" name="username" />
	<br />
	Password:
	<input type="password" name="password" />
	<br />
    Email:
    <input type="email" name="email">
	<button type="submit" name="gumb" value="login">Sign up</button>
	</form>
	</div>



<?php require_once __SITE_PATH . '/view/_footer.php'; ?>