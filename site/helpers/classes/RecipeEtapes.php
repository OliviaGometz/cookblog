<?php

class RecipeEtapes {
	public $val;
	public $errors = [];
	private $min = 3;
	private $max = 30;
	private $sizeMin = 20;
	private $sizeMax = 800;

	public function checkSize($key, $value) {
		if (strlen($value) < $this->sizeMin) {
			$this->errors[] = 'L\'étape '.$key.' est trop courte&nbsp;: il lui manque '.($this->sizeMin - strlen($value)). ' caractères.';
		}
		else if (strlen($value) > $this->sizeMax) {
			$this->errors[] = 'L\'étape '.$key.' est trop longue&nbsp;: il y a '.(strlen($value) - $this->sizeMax). ' caractères en trop. Raccourcissez-la ou créez une étape intermédiaire.';
		}
	}

	public function validate($tab) {
		if (count($tab) < $this->min) {
			$this->errors[] = 'Il doit y avoir au minimum '.$this->min.' étapes.';
		}
		elseif (count($tab) > $this->max) {
			$this->errors[] = 'Il y a trop d\'étapes&nbsp; vous ne pouvez en ajouter que '.$this->max.' maximum.';
		}
		else {
			foreach ($tab as $key => $value) {
				$this->checkSize($key, $value);
			}
		}

		if (empty($this->errors)) {
			foreach ($tab as $key => $value) {
				$this->val = $this->val . '(:recette, '.$key.', "'.ucfirst($value).'"),';
			}
			$this->val = rtrim($this->val, ",");
		}
	}
}