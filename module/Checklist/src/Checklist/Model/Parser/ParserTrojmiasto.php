<?php
namespace Checklist\Model\Parser;
use Checklist\Model\Parser\ParserAbstract;

class ParserTrojmiasto extends ParserAbstract {
    const PARSER_NAME = "trojmiasto";

    const SUBSTR_CZYNSZ = 7;
    const SUBSTR_DATA_DODANIA = 7;
    const SUBSTR_MIESZKANIE = 11;
    const SUBSTR_ROK_BUDOWY = 13;

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
        $this->data['ogrzewanie'] = "";
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
        $this->data['adres'] = $this->data['miejscowosc'] 
            + ', ' + $this->data['dzielnica'] + ', ' + $this->data['ulica'] ;
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