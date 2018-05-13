<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>
		<?php echo $title ?>
	</title>
</head>

<body>
	<?php require_once('helpers/bdd-connexion.php'); ?>
	<?php require_once('helpers/load-class.php'); ?>

	<?php
		if (isset($_POST['logout'])) {
			session_unset();
			session_destroy();
			unset($_POST['logout']);
		}
	?>

	<nav>
		<div class="<?php echo isset($_SESSION['id']) ? 'connected' : 'not-connected' ?>">
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