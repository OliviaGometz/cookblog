<?php /*
	if (
		!empty($_POST['pseudo'])
		&& !empty($_POST['email'])
		&& !empty($_POST['password'])
		&& !empty($_POST['password2'])
		&& !empty($_POST['secretCode'])
	) {




		$req = $bdd->prepare('
			INSERT INTO users (email, password, pseudo)
			VALUES (:email, :password, :pseudo)
		');

		$req->execute(
			array(
				'email' => $_POST['email'],
				'password' => $_POST['password'],
				'pseudo' => $_POST['pseudo']
			)
		);

		echo 'Bien enregistré !';
	}
	else {
		echo "Merci de remplir tous les champs.";
	}*/

	/*if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		echo "Cette adresse email est considérée comme valide.";
	}*/

//fonctionne avec bdd-connexion et load-class	

	$pseudo = new FormPseudo;
	$pseudo->validate(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING));
	var_dump($pseudo->val);
	echo '<br>';
	var_dump($pseudo->errors);
	echo '<br>';

	$email = new FormEmail;
	$email->validate(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
	var_dump($email->val);
	echo '<br>';
	var_dump($email->errors);
	echo '<br>';

	$password = new FormPassword;
	$password->validate(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING));
	var_dump($password->val);
	echo '<br>';
	var_dump($password->errors);
	echo '<br>';

	$code = new FormCode;
	$code->validate(filter_input(INPUT_POST, 'secretCode', FILTER_SANITIZE_STRING));
	var_dump($code->val);
	echo '<br>';
	var_dump($code->errors);
	echo '<br>';

?>

<form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="post">

	<input type="text" name="pseudo" placeholder="Votre pseudo">
	<input type="text" name="email" placeholder="Votre email">
	<input type="password" name="password" placeholder="Mot de passe">
	<input type="password" name="password2" placeholder="Retapez votre mot de passe">
	<input type="text" name="secretCode" placeholder="Code secret !">

	<input type="submit" value="S'inscrire">
</form>

