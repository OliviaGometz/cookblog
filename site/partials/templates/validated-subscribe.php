<div>
	<p>
		Bienvenue <?php echo isset($_POST['pseudo']) ? $_POST['pseudo'] : '' ?>&nbsp;!
	</p>

	<p>
		Ton inscription a bien été prise en compte.
	</p>

	<p>
		(on peut se tutoyer maintenant, n'est-ce pas&nbsp;?)
	</p>

	<p>
		Connecte-toi dès à présent avec ton pseudo ou ton email (et ton mot de passe, bien entendu)&nbsp;:
	</p>

	<?php include('../templates/form-login.php') ?>
</div>