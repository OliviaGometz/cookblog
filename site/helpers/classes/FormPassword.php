<?php

class FormPassword {
	public $val;
	public $errors = [];
	public $min = 6;
	public $max = 20;
	
	public function size($string) {
		if (strlen($string) < $this->min) {
			$this->errors[] = 'Votre mot de passe est trop court (seulement '.strlen($string).' caractère(s)). Il doit en compter '.$this->min.' au minimum.';
		}
		elseif (strlen($string) > $this->max) {
			$this->errors[] = 'Votre mot de passe est trop long ('.strlen($string).' caractères). Il doit en compter '.$this->max.' au maximum.';
		}
	}

	public function validate($string, $string2) {
		if ($string == NULL) {
			$this->errors[] = 'Veuillez renseigner un mot de passe.';
		}
		else {
			$this->size($string);

			if ($string2 == NULL) {
				$this->errors[] = 'Veuillez confirmer votre mot de passe.';
			}
			else {
				if ($string != $string2) {
					$this->errors[] = 'Les mots de passe saisis ne sont pas identiques. Veuillez confirmer votre mot de passe.';
				}
			}
		}

		if (empty($this->errors)) {
			$this->val = password_hash($string, PASSWORD_DEFAULT);
		}
	}
}
