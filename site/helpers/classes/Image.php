<?php

class Image {
	public $val;
	public $errors = [];
	private $maxMo = 2;
	private $mo = 1048576;
	private $maxSize;
	private $minHeight = 1080;
	private $minWidth = 1920;
	private $validsExtensions = ['png', 'jpg', 'jpeg'];
	private $path = '../../assets/uploads/';
	private $extension = '.png';

	public function __construct() {
		$this->maxSize = $this->mo * $this->maxMo;
	}

	public function resolution($image) {
		if (getimagesize($image['tmp_name'])[1] < $this->minHeight) {
			$this->errors[] = 'Cette image n\'est pas assez haute (seulement '.getimagesize($image['tmp_name'])[1].'px)&nbsp;: elle doit mesurer au minimum '.$this->minHeight.'px de haut.';
		}

		if (getimagesize($image['tmp_name'])[0] < $this->minWidth) {
			$this->errors[] = 'Cette image n\'est pas assez large (seulement '.getimagesize($image['tmp_name'])[0].'px)&nbsp;: elle doit mesurer au minimum '.$this->minWidth.'px de large.';
		}
	}

	public function size($image) {
		if ($image['size'] > $this->maxSize) {
			$this->errors[] = $this->sizeErrorMsg($image['size']);
		}
	}

	public function sizeErrorMsg($size) {
		return 'Cette image est trop lourde ('.$size/$this->mo.'&nbsp;Mo au lieu de '.$this->maxMo.'&nbsp;Mo maximum)&nbsp;: veuillez la compresser (vous pouvez utiliser <a href="https://tinypng.com/" target="_blank">TinyPNG</a>).';
	}

	public function check($image) {
		if (empty($image['name'])) {
			$this->errors[] = 'Veuillez sélectionner une image.';
		}
		elseif ($image['error'] == 1) {
			$this->errors[] = $this->sizeErrorMsg($image['size']);
		}
		elseif ($image['error'] > 0) {
			$this->errors[] = 'Une erreur s\'est produite lors de l\'upload de l\'image. Veuillez réessayer.';
		}
		else {
			if (!in_array(pathinfo($image['name'], PATHINFO_EXTENSION), $this->validsExtensions)) {
				$this->errors[] = 'Le format du fichier (.'.pathinfo($image['name'], PATHINFO_EXTENSION).') est incorrect&nbsp; veuillez uploader une image au format PNG, JPG ou JPEG.';
			}
			else {
				$this->size($image);
				$this->resolution($image);
			}
		}
	}

	public function rename($date, $authorId) {
		$date = str_replace([':', ' '], '-', $date);
		$name = $date.'_'.$authorId;
		$this->val = $this->path.$name.$this->extension;
	}

	public function validate($image, $date, $authorId) {
		$this->check($image);

		if (count($this->errors) == 0) {
			$this->rename($date, $authorId);
		}
	}
}