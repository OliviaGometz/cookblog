<?php

class RecipeIngredients {
	public $val;
	public $errors = [];
	private $min = 2;
	private $max = 30;
	private $ingId;
	private $ingMin = 2;
	private $ingMax = 20;
	private $unites = [];

	public function __construct() {
		global $bdd;

		$req3 = $bdd->prepare('
			SELECT id, quantifiable FROM unites
		');

		$req3->execute();

		while ($unites = $req3->fetch(PDO::FETCH_OBJ)) {
			$this->unites[$unites->id] = $unites->quantifiable;
		}

		$req3->closeCursor();
	}

	public function sizeIng($string) {
		if (strlen($string) < $this->ingMin) {
			$this->errors[] = '"'.$string.'"  est un nom trop court (seulement '.strlen($string).' caractère(s)). Un ingrédient doit en compter '.$this->ingMin.' au minimum.';
		}
		elseif (strlen($string) > $this->ingMax) {
			$this->errors[] = '"'.$string.'"  est un nom trop long ('.strlen($string).' caractères). Un ingrédient doit en compter '.$this->ingMax.' au maximum.';
		}
	}

	public function checkUniteQuantite($uniteId, $quantite) {
		if (!array_key_exists($uniteId, $this->unites)) {
			$this->errors[] = 'C\'est pas bien de tripatouiller le code&nbsp;!';
		}
		elseif ($this->unites[$uniteId] == 1) {
			if (!is_int($quantite)) {
				$this->errors[] = 'Veuillez rentrer une quantité valide.';
			}
		}
		else {
			$quantite = NULL;
		}
	}

	public function ing($string) {
		unset($this->ingId);
		
		$this->fetchIngId($string);

		if (!isset($this->ingId)) {
			$this->addNewIng($string);
			$this->fetchIngId($string);
		}
	}

	public function fetchIngId($string) {
		global $bdd;

		$req = $bdd->prepare('
			SELECT id, nom FROM ingredients
		');

		$req->execute();

		while ($ing = $req->fetch(PDO::FETCH_OBJ)) {
			if ($ing->nom == ucfirst($string)) {
				$this->ingId = (int)$ing->id;
			}
		}

		$req->closeCursor();
	}

	public function addNewIng($string) {
		global $bdd;

		$req2 = $bdd->prepare('
			INSERT INTO ingredients (nom)
			VALUES (:nom)
		');

		$req2->execute(
			[
				'nom' => $string
			]
		);

		$req2->closeCursor();
	}

	public function validate($tab) {
		if (count($tab) < $this->min) {
			$this->errors[] = 'Il doit y avoir au minimum '.$this->min.' ingrédients.';
		}
		elseif (count($tab) > $this->max) {
			$this->errors[] = 'Il y a trop d\'ingrédients&nbsp; vous ne pouvez en ajouter que '.$this->max.' maximum.';
		}
		else {
			foreach ($tab as $key => $value) {
				$this->sizeIng($key);
				$this->checkUniteQuantite((int)$value['unite'], (int)$value['quantite']);
			}
		}

		if (empty($this->errors)) {
			foreach ($tab as $key => $value) {
				$this->ing(ucfirst($key));
				$this->val = $this->val . '(:recette, '.$this->ingId.', '.(int)$value['unite'].', '.(int)$value['quantite'].'),';
			}
			$this->val = rtrim($this->val, ",");
		}
	}
}