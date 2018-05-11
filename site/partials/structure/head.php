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

	<?php if (isset($_SESSION['flash'])) : ?>
		<div class="flash">
			<?php if ($_SESSION['flash'] == 'justConnected') : ?>
				Bonjour <?php echo $_SESSION['pseudo'] ?>, comment ça va aujourd'hui&nbsp;?
			<?php endif ?>
		</div>
	<?php
		endif;
		unset($_SESSION['flash']);
	?>