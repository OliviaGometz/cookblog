<?php

class RecipeNom {
	public $val;
	public $errors = [];
	private $exists = false;
	public $min = 3;
	public $max = 50;
	
	public function size($string) {
		if (strlen($string) < $this->min) {
			$this->errors[] = 'Le nom de la recette est trop court (seulement '.strlen($string).' caractère(s)). Il doit en compter '.$this->min.' au minimum.';
		}
		elseif (strlen($string) > $this->max) {
			$this->errors[] = 'Le nom de la recette est trop long ('.strlen($string).' caractères). Il doit en compter '.$this->max.' au maximum.';
		}
	}

	public function stillExists($string) {
		global $bdd;

		$req = $bdd->prepare('
			SELECT nom FROM recettes
		');

		$req->execute();

		while ($recettes = $req->fetch(PDO::FETCH_OBJ)) {
			if (strtolower($recettes->nom) == strtolower($string)) {
				$this->exists = true;
			}
		}

		$req->closeCursor();

		if ($this->exists) {
			$this->errors[] = 'Cette recette existe déjà.';
		}
	}

	public function validate($string) {
		if ($string == NULL) {
			$this->errors[] = 'Veuillez donner un nom à votre recette.';
		}
		else {
			$this->size($string);
			$this->stillExists($string);
		}

		if (empty($this->errors)) {
			$this->val = ucfirst($string);
		}
	}
}