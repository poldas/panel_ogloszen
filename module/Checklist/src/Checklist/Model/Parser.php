<?php
namespace Checklist\Model;

use Zend\Dom\Query;
use Zend\Http\Client;
use Checklist\Model\Parser\ParserSlownik as Slownik;
use Checklist\Model\Parser\ParserTrojmiasto;
use Checklist\Model\Parser\ParserGratka;

class Parser {
        
    protected $url = '';
    protected $parser = '';
    protected $client = '';
    protected $result = '';
    
    /**
     * Obiekt Zend\Dom\Query
     * @var Zend\Dom\Query
     */
    protected $domobject = null;
    
    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }
    
    /**
     * Zwraca tablicę z danymi ze sparsowanej strony
     * 
     * @return array
     */
    public function getResult() {
        $this->setParser();
        $this->parse();
        return $this->result;
    }
    
    protected function parse() {
        $dom = $this->getDomObject();
        $this->parser->setDomObject($dom);
        $this->result = $this->parser->parse();
    }
    
    protected function setParser() {
        if(!$this->url) {
            throw new Exception("Brak urla");
        }
        $this->parser = $this->getParserByUrl($this->url);
        return $this;
    }
    
    /**
     * 
     * @return Zend\Dom\Query
     */
    protected function getDomObject() {
        if (!$this->domobject) {
            $this->setDomObject();
        }
        return $this->domobject;
    }
    
    protected function setDomObject() {
        if(!$this->client) {
            $this->setClient();
        }
        $body = $this->client->getResponse()->getBody();
        $this->domobject = new Query(html_entity_decode($body));
    }
    

    protected function setClient() {
        if (!$this->url) {
            throw new Exception("Brak ustawionego urla");
        }
        $this->client = new Client( $this->url );
        $this->client->setAdapter('Zend\Http\Client\Adapter\Curl');
        $this->client->setMethod('GET');
//        $this->client->setEncType(Client::ENC_URLENCODED);
        $this->client->send();
    }
    
    /**
     * Pobiera parser i ustawia url parsera
     *
     * @param string $url
     * @return ParserAbstract <ParserTrojmiasto, ParserGratka>
     */
    protected function getParserByUrl($url) {
        $idParser = $this->getParserId($url);
        $parser = $this->getParserById($idParser);
        $parser->setUrl($url);
        return $parser;
    }
    
    /**
     *
     * @param string $url
     * @return integer
     */
    protected function getParserId() {
        $idParser = 0;
        if (strrpos ( $this->url, Slownik::REGEXP_GRATKA ) !== false) {
            $idParser = Slownik::ID_PARSER_GRATKA;
        }

        if (strrpos ( $this->url, Slownik::REGEXP_TROJMIASTO ) !== false) {
            $idParser = Slownik::ID_PARSER_TROJMIASTO;
        }
        return $idParser;
    }
    
    /**
     * Pobiera id obiekt parsera wg id parsera
     *
     * @param integer $idParser
     * @throws Exception
     * @return ParserAbstract <ParserTrojmiasto, ParserGratka>
     */
    private static function getParserById($idParser) {
        $parser = null;

        switch ($idParser) {
            case Slownik::ID_PARSER_TROJMIASTO :
                    $parser = new ParserTrojmiasto();
                    break;
            case Slownik::ID_PARSER_GRATKA :
                    $parser = new ParserGratka();
                    break;
            default :
                    $dostepne_parsery = join ( ', ', Slownik::pobierz_dostepne_parsery() );
                    $errMsg = "Nie ma obiektu parsera o id: " . $idParser . "<br> Użyj dostępnego parsera: " . $dostepne_parsery;
                    throw new \Exception ( $errMsg );
                    break;
        }

        return $parser;
    }
}