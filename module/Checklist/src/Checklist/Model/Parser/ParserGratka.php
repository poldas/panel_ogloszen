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
        $this->pobierzCenaMetr2Czynsz();
        
        $this->parsujLiczby();
        $this->parsujAdres();
    }

    protected function parsujAdres() {
        $this->data['adres'] = $this->data['miejscowosc'] 
            .', '.$this->data['dzielnica'].', ul. '.$this->data['ulica'] ;
    }
    
    protected function pobierzCena() {
        $nodes = $this->getDomObject()->execute(
            "#karta-ogloszenia div.cenaGlowna p b"
        );
        
        $wartosc = $nodes[0]->nodeValue;
        $wartosc = htmlentities($wartosc, ENT_COMPAT, 'UTF-8');
        $wartosc = str_replace('&nbsp;', '', $wartosc);
        $this->data['cena'] = $wartosc;
    }
    
    protected function pobierzCenaMetr2Czynsz() {
        $nodes = $this->getDomObject()->execute(
            "#karta-ogloszenia ul.cenaOpis li b"
        );

        if (isset($nodes[1])) {
            $this->data['cenam2'] = $nodes[1]->nodeValue;
            $this->data['czynsz'] = $nodes[0]->nodeValue;
        } else {
            $this->data['cenam2'] = $nodes[0]->nodeValue;
        }
    }
    
    protected function pobierzAdres() {
        $nodes = $this->getDomObject()->execute(
            "#karta-naglowek div div h2.hide-for-small"
        );
        $wynik = $nodes[0]->nodeValue;
        $tmp = explode(',', $wynik);
        $gmina = array_pop($tmp);
        $powiat = array_pop($tmp);
        $ulica = array_pop($tmp);
        $dzielnica = array_pop($tmp);

        $this->data['miejscowosc'] = str_replace('Gmina', '', $gmina);
        $this->data['ulica'] = $ulica;
        $this->data['dzielnica'] = str_replace('mieszkanie na sprzedaż', '', $dzielnica);
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
                \Zend\Debug\Debug::dump($tmp[0], 'tmp');
                \Zend\Debug\Debug::dump($label, 'label');
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
            $tmp = mb_split('\n', trim($node->nodeValue));
            try {
                $label = ParserSlownik::getLabelName($tmp[0]);
                                               \Zend\Debug\Debug::dump($tmp[0], 'tmp');
                \Zend\Debug\Debug::dump($label, 'label');
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