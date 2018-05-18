<?php

class RecipeDuree {
	public $val;
	private $hours;
	private $minutes;
	public $errors = [];
	public $hourMin = 0;
	public $hourMax = 24;
	public $minMin = 0;
	public $minMax = 55;
	public $minStep = 5;

	public function base($time, $texte, $min, $max, $step = 1) {
		$time = (int)$time;

		if ($time === NULL) {
			$this->errors[] = 'Veuillez renseigner le nombre de '.$texte.'.';
		}
		elseif ($time < $min || $time > $max) {
			$this->errors[] = 'Le nombre de '.$texte.' doit être compris entre '.$min.' et '.$max.'.';
		}
		elseif ($time % $step != 0) {
			$this->errors[] = 'Le nombre de '.$texte.' doit être un multiple de '.$step.', ('.($step*0).', '.($step*2).', '.($step*3).', '.($step*7).'&hellip;).';
		}
		elseif ($time < 10) {
			return '0'.$time;
		}
		else {
			return $time;
		}
	}

	public function format($hours, $minutes) {
		if(isset($hours) && isset($minutes)) {
			$this->val = $hours.':'.$minutes.':00';
		}
	}

	public function validate($dureeHour, $dureeMin) {
		$this->hours = $this->base($dureeHour, 'heures', $this->hourMin, $this->hourMax);
		$this->minutes = $this->base($dureeMin, 'minutes', $this->minMin, $this->minMax, $this->minStep);
		$this->format($this->hours, $this->minutes);
	}
}