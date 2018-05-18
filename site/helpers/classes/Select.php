<?php

class Select {
	public $val;
	public $errors = [];

	public function validate($value, $options, $name) {
		if ($value == NULL) {
			$this->errors[] = 'Veuillez choisir '.$name.'.';
		}
		else {
			$value = (int)$value;

			if (in_array($value, $options)) {
				$this->val = $value;
			}
			else {
				$this->errors[] = 'C\'est pas bien de bidouiller dans le code&nbsp;!';
			}
		}
	}
}