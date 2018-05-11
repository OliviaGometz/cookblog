<?php
	if (isset($_SESSION['pseudo'])) {
		$pseudo = $_SESSION['pseudo'];
		session_unset();
	}
	elseif (isset($_POST['pseudo'])) {
		$pseudo = $_POST['pseudo'];
	}
?>

<form id="login" action="partials/traitements/form-login.php" method="post">
	<?php if (isset($pseudo)) : ?>
		<header>
			Bienvenue à toi, <?php echo $pseudo ?>&nbsp;!
			(maintenant qu'on se connait bien, on peut se tutoyer, n'est-ce pas ?)
			Ton compte a bien été créé, tu peux dès à présent te connecter avec ton pseudo ou ton email (ainsi que ton mot de passe, cela va de soit)&nbsp;:
		</header>
	<?php endif ?>

	<input type="text" name="login" placeholder="Pseudo ou email" value="<?php echo isset($pseudo) ? $pseudo : '' ?>">
	<input type="password" name="password" placeholder="Mot de passe">

	<?php if (isset($_SESSION['errors'])) : ?>
		<ul>
			<?php foreach ($_SESSION['errors'] as $value) : ?>
				<li>
					<?php echo $value ?>
				</li>
			<?php endforeach ?>
		</ul>
	<?php
		session_unset();
		endif;
	?>

	<input type="submit" value="Me connecter">
</form>