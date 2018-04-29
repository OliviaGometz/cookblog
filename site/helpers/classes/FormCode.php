<?php

class FormCode {
	public $val = false;
	public $errors = [];
	private $code = '$2y$10$V8ItMuKDtMov9FzhYGHtfeCbl9dMXveI024uHt/PL4Y6hSvk5JrMG';
	
	public function validate($string) {
		if (password_verify($string, $this->code)) {
			$this->val = true;
		}
		else {
			$this->errors[] = 'Le code secret est invalide&nbsp;!';
		}
	}
}
