<?php
	if (isset($_POST['logout'])) {
		session_unset();
		session_destroy();
		unset($_POST['logout']);
	}
?>

<nav>
	<div class="<?php echo isset($_SESSION['id']) ? 'connected' : 'no-connected' ?>">
		<button>
			Bonhomme
		</button>
		<ul>
			<?php if (isset($_SESSION['id'])) : ?>
			<li>
				<a href="">
					Mon profil
				</a>
			</li>
			<li>
				<a href="">
					Mon compte
				</a>
			</li>
			<li>
				<form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="post">
					<input type="submit" name="logout" value="Déconnexion">
				</form>
			</li>

			<?php else : ?>
			<li data-target="connexion">
				Connexion
			</li>
			<li data-target="inscription">
				Inscription
			</li>

			<?php endif ?>
		</ul>
	</div>
</nav>

<aside class="popin" style="display: none">
	<?php if (isset($_SESSION['id'])) : ?>
	

	<?php else : ?>
	<div id="connexion" class="popin-content">
		<?php include_once('partials/templates/form-login.php'); ?>
	</div>
	<div id="inscription" class="popin-content">
		<?php include_once('partials/templates/form-subscribe.php'); ?>
	</div>

	<?php endif ?>
</aside>