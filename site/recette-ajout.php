<?php
	$title = 'Ajouter une recette';
	require_once('partials/structure/head.php');
?>

<?php 
	if (!isset($_SESSION['id'])) {
		header('Location: index.php');
		return;
	}
?>

<div id="ajout">
	<?php include_once('partials/templates/recipe-add.php'); ?>
</div>

<?php require_once('partials/structure/end.php'); ?>