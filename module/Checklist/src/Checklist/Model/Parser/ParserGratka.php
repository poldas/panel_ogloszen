<?php
namespace Checklist\Model\Parser;

use Checklist\Model\Parser\ParserAbstract;
class ParserGratka extends ParserAbstract {
    const PARSER_NAME = "gratka";

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
        $this->data['id'] = 0;
        $this->pobierzMieszkanie();
        $this->pobierzBudynek();
        $this->pobierzOpis();
        $this->pobierzAdres();
        $this->pobierzCena();
        $this->pobierzCenaMetr2();
        $this->data['czynsz'] = "";
        $this->data['ogrzewanie'] = "";
        $this->data['rodzaj_budynku'] = "";
        $this->data['stan'] = '';
        $this->parsujLiczby();
    }

    protected function pobierzCena() {
        $nodes = $this->getDomObject()->execute(
            "#karta-ogloszenia div.cenaGlowna p b"
        );
        $this->data['cena'] = $nodes[0]->nodeValue;
    }
    
    protected function pobierzCenaMetr2() {
        $nodes = $this->getDomObject()->execute(
            "#karta-ogloszenia ul.cenaOpis li b"
        );
        $this->data['cena_za_m2'] = $nodes[0]->nodeValue;
    }
    
    protected function pobierzAdres() {
        $nodes = $this->getDomObject()->execute(
            "#karta-naglowek div div h2.hide-for-small"
        );
        $wynik = $nodes[0]->nodeValue;
        $tmp = explode(',', $wynik);
        $this->data['adres'] = $wynik;
        $this->data['miejscowosc'] = "";
        $this->data['powiat'] = $tmp[1];
        $this->data['ulica'] = $tmp[0];
        $this->data['gmina'] = $tmp[2];
        $this->data['dzielnica'] = "";
    }

     protected function pobierzOpis() {
        $nodes = $this->getDomObject()->execute(
            "#opis-dodatkowy div p"
        );
        $wynik = $nodes[0]->nodeValue;
        $this->data['opis'] = $wynik;
    }

    protected function pobierzMieszkanie() {
        $nodes = $this->getDomObject()->execute(
            "div#dane-podstawowe div.mieszkanie ul li"
        );
        $wynik = array();
        $bledy = array();
        foreach ($nodes as $key => $node) {
            $tmp = mb_split('\n', trim($node->nodeValue));
            try {
                $label = ParserSlownik::getLabelName($tmp[0]);
                if (empty($label)) {
                    continue;
                }
                $value = trim($tmp[1]);
                $this->data[$label] = $value;
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
                $bledy[] = "label: ".$label." wartosc: ".$value;
            }
        }
        if($bledy) {
            echo join('\n', $bledy);
            return false;
        }
        return true;
    }

    protected function pobierzBudynek() {
        $nodes = $this->getDomObject()->execute(
            "div#dane-podstawowe div.budynek ul li"
        );
        $wynik = array();
        $bledy = array();
        foreach ($nodes as $key => $node) {
            mb_regex_encoding('UTF-8');
            $tmp = mb_split('\n', trim($node->nodeValue));
            try {
                $label = ParserSlownik::getLabelName($tmp[0]);
                if (empty($label)) {
                    continue;
                }
                $value = trim($tmp[1]);
                $this->data[$label] = $value;
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
                $bledy[] = "label: ".$label." wartosc: ".$value;
            }
        }
        if($bledy) {
            echo join('\n', $bledy);
            return false;
        }
        return true;
    }
}
?>