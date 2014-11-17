<?php
namespace Checklist\Model\Parser;

abstract class ParserAbstract {

	const PARSER_NAME = "niezdefiniowany";

	protected $url = "";

	/**
	 *
	 * @var Zend\Dom\Query
	 */
	protected $dom = null;

	/**
	 * Tablica danych wyjściowych
         * 
	 * @var array
	 */
	protected $data = null;
        
	public function parse() {
            if(!$this->dom) {
                throw new Exception("Brak obiektu DOM");
            }
            $this->setDataObject();
            unset($this->data['cena_za_m2']);
            unset($this->data['powiat']);
            unset($this->data['gmina']);
            unset($this->data['opis']);
            return $this->getDataObject();
	}

        public function setUrl($url) {
            $this->url = $url;
        }
        
        /**
         * Ustawia uzupełnioną danymi tablice danych
         */
        protected abstract function setDataObject();
        
        /**
         * 
         * @param Zend\Dom\Query $dom
         */
        public function setDomObject($dom) {
            $this->dom = $dom;
        }
        
        protected function getDataObject() {
            return $this->data;
        }
    
        /**
         * 
         * @return Zend\Dom\Query
         */
        protected function getDomObject() {
            return $this->dom;
        }
        
        protected function parsujLiczby() {
            $tmp = $this->data['cena'];
            $this->data['cena'] = floatval(str_replace(" ", "", $tmp));
            $tmp = $this->data['cena_za_m2'];
            $this->data['cena_za_m2'] = floatval(str_replace(" ", "", $tmp));
            $tmp = $this->data['powierzchnia'];
            $this->data['powierzchnia'] = floatval(str_replace(" ", "", $tmp));
        }
}