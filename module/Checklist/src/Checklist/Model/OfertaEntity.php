<?php
namespace Checklist\Model;

class OfertaEntity {
	protected $id;
	protected $powierzchnia;
	protected $cena;
        protected $cenam2;
	protected $czynsz;
	protected $liczbaPokoi;
        protected $liczbaPieter;
	protected $adres;
	protected $miejscowosc;
	protected $formaWlasnosci;
	protected $ulica;
	protected $rokBudowy;
	protected $stan;
	protected $pietro;
        protected $opis;
	protected $rodzajBudynku;
	protected $ogrzewanie;
        protected $material;
        protected $url;

	public function getId() {
		return $this->id;
	}

	public function setId($Value) {
		$this->id = $Value;
	}

	public function getPowierzchnia() {
		return $this->powierzchnia;
	}

	public function setPowierzchnia($Value) {
		$this->powierzchnia = $Value;
	}

	public function getCena() {
		return $this->cena;
	}

	public function setCena($Value) {
		$this->cena = $Value;
	}

        public function getCenam2() {
		return $this->cenam2;
	}

	public function setCenam2($Value) {
		$this->cenam2 = $Value;
	}
        
	public function getCzynsz() {
		return $this->czynsz;
	}

	public function setCzynsz($Value) {
		$this->czynsz = $Value;
	}

	public function getLiczbaPokoi() {
		return $this->liczbaPokoi;
	}

	public function setLiczbaPokoi($Value) {
		$this->liczbaPokoi = $Value;
	}

	public function getLiczbaPieter() {
		return $this->liczbaPieter;
	}

	public function setLiczbaPieter($Value) {
		$this->liczbaPieter = $Value;
	}
	public function getAdres() {
		return $this->adres;
	}

	public function setAdres($Value) {
		$this->adres = $Value;
	}

	public function getMiejscowosc() {
		return $this->miejscowosc;
	}

	public function setMiejscowosc($Value) {
		$this->miejscowosc = $Value;
	}

	public function getFormaWlasnosci() {
		return $this->formaWlasnosci;
	}

	public function setFormaWlasnosci($Value) {
		$this->formaWlasnosci = $Value;
	}

	public function getUlica() {
		return $this->ulica;
	}

	public function setUlica($Value) {
		$this->ulica = $Value;
	}
	public function getRokBudowy() {
		return $this->rokBudowy;
	}

	public function setRokBudowy($Value) {
		$this->rokBudowy = $Value;
	}

	public function getStan() {
		return $this->stan;
	}

	public function setStan($Value) {
		$this->stan = $Value;
	}
	public function getPietro() {
		return $this->pietro;
	}

	public function setPietro($Value) {
		$this->pietro = $Value;
	}

	public function getRodzajBudynku() {
		return $this->rodzajBudynku;
	}

	public function setRodzajBudynku($Value) {
		$this->rodzajBudynku = $Value;
	}
	public function getOpis() {
		return $this->opis;
	}

	public function setOpis($Value) {
		$this->opis = $Value;
	}
        
	public function getOgrzewanie() {
		return $this->ogrzewanie;
	}

	public function setOgrzewanie($Value) {
		$this->ogrzewanie = $Value;
	}
        
	public function getMaterial() {
		return $this->material;
	}

	public function setMaterial($Value) {
		$this->material = $Value;
	}
        
        public function getUrl() {
		return $this->url;
	}

	public function setUrl($Value) {
		$this->url = $Value;
	}
}
