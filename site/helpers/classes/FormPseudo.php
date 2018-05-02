<?php

class FormPseudo {
	public $val;
	public $errors = [];
	private $exists = false;
	public $min = 3;
	public $max = 15;
	
	public function size($string) {
		if (strlen($string) < $this->min) {
			$this->errors[] = 'Votre pseudo est trop court (seulement '.strlen($string).' caractère(s)). Il doit en compter '.$this->min.' au minimum.';
		}
		elseif (strlen($string) > $this->max) {
			$this->errors[] = 'Votre pseudo est trop long ('.strlen($string).' caractères). Il doit en compter '.$this->max.' au maximum.';
		}
	}

	public function type($string) {
		if (!ctype_alpha($string)) {
			$this->errors[] = 'Votre pseudo contient des caractères prohibés (chiffres, espaces, tirets...). Merci de n\'utiliser que des lettres (majuscules et/ou minuscules).';
		}
	}

	public function stillExists($string) {
		global $bdd;

		$req = $bdd->prepare('
			SELECT pseudo FROM users
		');

		$req->execute();

		while ($users = $req->fetch(PDO::FETCH_OBJ)) {
			if ($users->pseudo == $string) {
				$this->exists = true;
			}
		}

		$req->closeCursor();

		if ($this->exists) {
			$this->errors[] = 'Ce pseudo existe déjà. Veuillez en choisir un autre.';
		}
	}

	public function validate($string) {
		if ($string == NULL) {
			$this->errors[] = 'Veuillez renseigner un pseudo.';
		}
		else {
			$this->size($string);
			$this->type($string);
			$this->stillExists($string);
		}

		if (empty($this->errors)) {
			$this->val = ucfirst($string);
		}
	}
}
