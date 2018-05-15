<?php

class RecipeDesc {
	public $val;
	public $errors = [];
	public $min = 10;
	public $max = 255;
	
	public function size($string) {
		if (strlen($string) < $this->min) {
			$this->errors[] = 'La description de la recette est trop courte (seulement '.strlen($string).' caractère(s)). Elle doit en compter '.$this->min.' au minimum.';
		}
		elseif (strlen($string) > $this->max) {
			$this->errors[] = 'La description de la recette est trop longue ('.strlen($string).' caractères). Elle doit en compter '.$this->max.' au maximum.';
		}
	}

	public function validate($string) {
		if ($string == NULL) {
			$this->errors[] = 'Veuillez remplir la description de votre recette.';
		}
		else {
			$this->size($string);
		}

		if (empty($this->errors)) {
			$this->val = ucfirst($string);
		}
	}
}
