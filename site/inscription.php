<?php 
	if (!isset($_SESSION['id'])) {
		header('Location: index.php');
		return;
	}
?>

<?php
	$title = 'Inscription';
	require_once('partials/structure/head.php');
?>

<main>
	<?php include_once('partials/templates/form-subscribe.php'); ?>
</main>

<?php require_once('partials/structure/end.php'); ?>