<?php
	if (isset($_POST['logout'])) {
		session_unset();
		session_destroy();
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
			<li>
				<a href="connexion.php">
					Connexion
				</a>
			</li>
			<li>
				<a href="inscription.php">
					Inscription
				</a>
			</li>

			<?php endif ?>
		</ul>
	</div>
</nav>