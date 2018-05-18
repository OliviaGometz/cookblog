<?php

class RecipeDifficulte {
	public $val;
	public $errors = [];
	private $options = [1, 2, 3];

	public function validate($value) {
		if ($value == NULL) {
			$this->errors[] = 'Veuillez choisir une difficulté.';
		}
		else {
			$value = (int)$value;

			if (in_array($value, $this->options)) {
				$this->val = $value;
			}
			else {
				$this->errors[] = 'C\'est pas bien de bidouiller dans le code&nbsp;!';
			}
		}
	}
}