<?php
	$title = 'Cookblog';
	require_once('partials/structure/head.php');
?>

<?php require_once('helpers/bdd-connexion.php') ?>
<?php require_once('helpers/load-class.php') ?>

<a href="inscription.php">
	S'inscrire
</a>

<!--
<form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="post" style="margin-bottom: 30px">
	<input type="text" name="pays" placeholder="Pays" />
	<input type="submit" value="Rechercher" />
</form>


<div style="background: #efefef; padding: 20px">
	<?php
		if(!empty($_POST['pays'])) {
			$req = $bdd->prepare('
				SELECT * FROM septembre2015 WHERE Pays = :pays
			');

			$req->execute(
				array(
					'pays' => $_POST['pays']
				)
			);
			
			while ($vol=$req->fetch(PDO::FETCH_ASSOC)) {
				echo $vol['Commandant'].' | '.$vol['Type'].'<br />';
			}

			$req->closeCursor();
		}
	?>
</div>
		
<?php require_once('partials/structure/end.php') ?>