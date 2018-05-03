<?php

class FormCode {
	public $val;
	public $errors = [];
	private $code = '$2y$10$V8ItMuKDtMov9FzhYGHtfeCbl9dMXveI024uHt/PL4Y6hSvk5JrMG';
	
	public function validate($string) {
		if (password_verify($string, $this->code)) {
			$this->val = 2;
		}
		else if ($string == '') {
			$this->val = 1;
		}
		else {
			$this->errors[] = 'Le code entré est incorrect. Si vous ne le connaissez pas, laissez ce champ vide afin de valider votre inscription.';
		}
	}
}
