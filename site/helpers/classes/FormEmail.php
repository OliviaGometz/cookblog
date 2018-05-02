<?php

class FormEmail {
	public $val;
	public $errors = [];
	private $exists = false;

	public function stillExists($string) {
		global $bdd;

		$req = $bdd->prepare('
			SELECT email FROM users
		');

		$req->execute();

		while ($users = $req->fetch(PDO::FETCH_OBJ)) {
			if ($users->email == $string) {
				$this->exists = true;
			}
		}

		$req->closeCursor();

		if ($this->exists) {
			$this->errors[] = 'Il existe déjà un compte associé à cette adresse email. Veuillez vous connecter avec cette adresse email et votre mot de passe.';
		}
		else {
			$this->val = $string;
		}
	}

	public function validate($string) {
		if ($string == NULL) {
			$this->errors[] = 'Veuillez renseigner une adresse email.';
		}
		elseif ($string) {
			$this->stillExists($string);
		}
		else {
			$this->errors[] = 'Votre email est invalide.';
		}
	}
}
