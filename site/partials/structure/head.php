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
	<nav>
		<div>
			<button>
				Bonhomme
			</button>
			<ul>
				<?php if (isset($_SESSION['id'])) : ?>
				<li>
					<a href="recette-ajout.php">
						Ajouter une recette
					</a>
				</li>
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
				<li id="logout">
					Déconnexion
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

	<main>