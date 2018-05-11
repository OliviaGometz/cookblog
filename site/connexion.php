<?php
	if (!isset($_SESSION['id'])) {
		header('Location: index.php');
		return;
	}
?>

<?php
	$title = 'Connexion';
	require_once('partials/structure/head.php');
?>

<main>
	<?php include_once('partials/templates/form-login.php'); ?>
</main>

<?php require_once('partials/structure/end.php'); ?>