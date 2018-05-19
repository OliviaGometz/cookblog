<?php

class Image {
	public $val;
	public $errors = [];
	private $max = 2097152; //2Mo
	private $errorSize = 'Cette image pèse trop lourd&nbsp;: veuillez la compresser (vous pouvez utiliser <a href="https://tinypng.com/" target="_blank">TinyPNG</a>).';

	public function size($image) {
		if ($image['size'] > $this->max) {
			$this->errors[] = $this->errorSize;
		}
	}

	public function validate($image) {
		if (empty($image['name'])) {
			$this->errors[] = 'Veuillez sélectionner une image.';
		}
		elseif ($image['error'] == 1) {
			$this->errors[] = $this->errorSize;
		}
		elseif ($image['error'] > 0) {
			$this->errors[] = 'Une erreur s\'est produit lors de l\'upload de l\'image. Veuillez réessayer.';
		}
		else {
			$this->size($image);
			//résolution image
		}
	}
}