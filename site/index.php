<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>
		Accueil
	</title>
</head>

<body>
	<?php require_once('helpers/bdd-connexion.php') ?>
	<?php require_once('helpers/load-class.php') ?>

	<?php include('partials/forms/form-subscribe.php') ?>


	<!--

	<form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="post" style="margin-bottom: 30px">
		<input type="text" name="pays" placeholder="Pays" />
		<input type="submit" value="Rechercher" />
	</form>
	
	<h1>Avions et commandants selon pays</h1>
	
	<div style="background: #efefef; padding: 20px">
		<form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="post" style="margin-bottom: 30px">
			<input type="text" name="pays" placeholder="Pays" />
			<input type="submit" value="Rechercher" />
		</form>
		
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
			}
		?>
	</div>
	
	<h1>Tous les vols</h1>
	
	<div style="border: solid 3px #33ad73; height: 500px; overflow-y: scroll; padding: 20px">
		<?php
			$req = $bdd->prepare('
				SELECT * FROM septembre2015
			');

			$req->execute();
			
			while ($vol=$req->fetch(PDO::FETCH_ASSOC)) {
				//var_dump($vol);
				echo 
					$vol['ID'].
					' | '.$vol['Date'].
					' | '.$vol['Heure'].
					' | '.$vol['Pays'].
					' | '.$vol['Ville'].
					' | '.$vol['Commandant'].
					' | '.$vol['Duree'].
					' | '.$vol['Type'].
					' | '.$vol['Code'].
					'.<br />';
			}

			$req->closeCursor();
		?>
	</div>
	
	<h1>Vols 140 - 155</h1>
	
	<div style="border: solid 3px #33ad73; height: 200px; overflow-y: scroll; padding: 20px">
		<?php
			$req = $bdd->prepare('
				SELECT * FROM septembre2015 WHERE ID > 139 AND ID < 156
			');

			$req->execute();
			
			while ($vol=$req->fetch(PDO::FETCH_ASSOC)) {
				//var_dump($vol);
				echo 
					$vol['ID'].
					' | '.$vol['Date'].
					' | '.$vol['Heure'].
					' | '.$vol['Pays'].
					' | '.$vol['Ville'].
					' | '.$vol['Commandant'].
					' | '.$vol['Duree'].
					' | '.$vol['Type'].
					' | '.$vol['Code'].
					'.<br />';
			}
		?>
	</div>
	
	<h1>Pays de destination (avec doublons)</h1>
	
	<div style="border: solid 3px #33ad73; height: 500px; overflow-y: scroll; padding: 20px">
		<?php
			$req = $bdd->prepare('
				SELECT Pays FROM septembre2015
			');

			$req->execute();

			while ($vol=$req->fetch(PDO::FETCH_ASSOC)) {
				echo $vol['Pays'].'<br />';
			}
		?>
	</div>
	
	<h1>Pays de destination (sans doublon)</h1>
	
	<div style="border: solid 3px #33ad73; padding: 20px">
		<?php
			$req = $bdd->prepare('
				SELECT DISTINCT Pays FROM septembre2015 ORDER BY Pays ASC
			');

			$req->execute();
			
			while ($vol=$req->fetch(PDO::FETCH_ASSOC)) {
				echo $vol['Pays'].'<br />';
			}
		?>
	</div>
	
-->
	
	
		
</body>
</html>