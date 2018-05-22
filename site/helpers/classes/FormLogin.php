<?php

class FormLogin {
	private $testType;
	private $type;
	private $det;
	public $errors = [];
	private $user;
	public $userId = null;
	public $userRole = null;
	public $userPseudo = null;

	public function connexion($login, $password) {
		if ($login == NULL) {
			$this->errors[] = 'Tu n\'as pas renseigné ton pseudo ou ton email&nbsp!';
		}
		else {
			$this->testType = strpos($login, '@');
			$this->type = $this->testType ? 'email' : 'pseudo';
			$this->det = $this->testType ? 'cet ' : 'ce ';

			global $bdd;

			$req = $bdd->prepare(
				'SELECT id, role, pseudo, password FROM users WHERE '.$this->type.' = "'.$login.'"'
			);

			$req->execute();

			$this->user = $req->fetch(PDO::FETCH_OBJ);
			$req->closeCursor();

			if (!$this->user) {
				$this->errors[] = 'Il n\'existe aucun compte correspondant à '.$this->det.$this->type.'. Inscris-toi, ça prend 30 secondes&nbsp!';
			}
			else {
				if (password_verify($password, $this->user->password)) {
					$this->userId = $this->user->id;
					$this->userRole = $this->user->role;
					$this->userPseudo = $this->user->pseudo;
				}
				else {
					$this->errors[] = 'Le mot de passe est incorrect. Pour rappel, il fait entre 6 et 30 caractères. Si tu ne t\'en souviens plus, demande à Olivia de le changer pour toi.';
				}
			}
		}
	}
}
