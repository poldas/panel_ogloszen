<?php
namespace Checklist\Model\Parser;
use Checklist\Model\Parser\ParserAbstract;

class ParserTrojmiasto extends ParserAbstract {
    const PARSER_NAME = "trojmiasto";

    /**
     * (non-PHPdoc)
     *
     * @see ParserAbstract::setDataObject()
     */
    protected function setDataObject() {
        $this->data = array();
        $this->data['id'] = 0;
        $this->pobierzDaneTabelkowe();
        $this->pobierzOpis();
        $this->data['rodzaj_budynku'] = "";
        $this->data['stan'] = '';
        $this->data['powiat'] = '';
        $this->data['gmina'] = '';
        
        $this->parsujLiczby();
        $this->parsujAdres();
    }

    protected function pobierzOpis() {
        $nodes = $this->getDomObject()->execute(
            "div.adv-body div.adv-longdesc"
        );
        $this->data['opis'] = $nodes[0]->nodeValue;
    }
    
    protected function parsujAdres() {
        $miejscowosc = $this->data['miejscowosc'];
        $dielnica = isset($this->data['dzielnica'])? $this->data['dzielnica']: "";
        $ulica = $this->data['ulica'];
        $adres = array();
        if(!empty($miejscowosc)) {
            $adres[] = $miejscowosc;
        }
        if(!empty($dielnica)) {
            $adres[] = $dielnica;
        }
        if(!empty($ulica)) {
            $adres[] = 'ul. '.$ulica;
        }
        $this->data['adres'] = join($adres, ', ');
    }
    
    
    protected function pobierzDaneTabelkowe() {
        $nodes = $this->getDomObject()->execute(
            "div.adv-features table tr"
        );
        
        foreach ($nodes as $key => $node) {
            $node = str_replace(array(' ','\n'), '', $node->nodeValue);
            $tmp = explode(':', $node);
            $label = ParserSlownik::getLabelName($tmp[0]);
            if (empty($label)) {
                continue;
            }
            $value = trim($tmp[1]);
            $this->data[$label] = $value;
        }
    }
}
?>