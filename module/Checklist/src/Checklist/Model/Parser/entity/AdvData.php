<?php
namespace Checklist\Model\Parser\entity;
class AdvData {

    public $id;
	public $cena;
	public $powierzchnia;
	public $adres;
	public $czynsz;
	public $stan;
	public $rokBudowy;
	public $liczbaPokoi;
	public $pietro;
	public $cenaMetr;
	public $dataDodania;

    public function setId($id) {
		$this->id = $id;
	}

	public function setCena($cena) {
		$this->cena = $cena;
	}

	public function setPowierzchnia($powierzchnia) {
		$this->powierzchnia = $powierzchnia;
	}

	public function setCzynsz($czynsz) {
		$this->czynsz = $czynsz;
	}

	public function setAdres($adres) {
		$this->adres = $adres;
	}

	public function setStan($stan) {
		$this->stan = $stan;
	}

	public function setLiczbaPokoi($liczbaPokoi) {
		$this->liczbaPokoi = $liczbaPokoi;
	}

	public function setRokBudowy($rokBudowy) {
		$this->rokBudowy = $rokBudowy;
	}

	public function setPietro($pietro) {
		$this->pietro = $pietro;
	}

	public function setCenaMetr($cenaMetr) {
		$this->cenaMetr = $cenaMetr;
	}

	public function setDataDodania($dataDodania) {
		$this->dataDodania = $dataDodania;
	}

	public function setUrl($url) {
		$this->url = $url;
	}



	public function getId() {
		return $this->id;
	}

	public function getCena() {
		return $this->cena;
	}

	public function getPowierzchnia() {
		return $this->powierzchnia;
	}

	public function getCzynsz() {
		return $this->czynsz;
	}

	public function getAdres() {
		return $this->adres;
	}

	public function getStan() {
		return $this->stan;
	}

	public function getLiczbaPokoi() {
		return $this->liczbaPokoi;
	}

	public function getRokBudowy() {
		return $this->rokBudowy;
	}

	public function getPietro() {
		return $this->pietro;
	}

	public function getCenaMetr() {
		return $this->cenaMetr;
	}

	public function getDataDodania() {
		return $this->dataDodania;
	}

	public function getUrl() {
		return $this->url;
	}
}
?>