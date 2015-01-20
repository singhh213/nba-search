<?php

 class Player {
 	private $name;
 	private $gamesP;
 	private $fgp;
 	private $tpp;
 	private $ftp;
 	private $ppg;

 	public function __construct($name, $gamesP, $fgp, $tpp, $ftp, $ppg) {
		$this->name = $name;
		$this->gamesP = $gamesP;
		$this->fgp = $fgp;
		$this->tpp = $tpp;
		$this->ftp = $ftp;
		$this->ppg = $ppg;
	}

	public function getName() {
		return $this->name;
	}

	public function getGP() {
		return $this->gamesP;
	}

	public function getFgp() {
		return $this->fgp;
	}

	public function getTpp() {
		return $this->tpp;
	}

	public function getFtp() {
		return $this->ftp;
	}

	public function getPpg() {
		return $this->ppg;
	}
}

?>