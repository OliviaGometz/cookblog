<form id="login" action="partials/traitements/form-login.php" method="post">
	<input type="text" name="login" placeholder="Pseudo ou email" value="<?php echo isset($_POST['pseudo']) ? $_POST['pseudo'] : '' ?>">
	<input type="password" name="password" placeholder="Mot de passe">

	<input type="submit" value="Me connecter">
</form>