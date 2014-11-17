<?php
/*
CREATE TABLE `oferty_nieruchomosci` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`powierzchnia` varchar(20) COLLATE utf8_polish_ci DEFAULT 'brak',
`cena` varchar(20) COLLATE utf8_polish_ci DEFAULT 'brak',
`cenam2` varchar(20) COLLATE utf8_polish_ci DEFAULT 'brak',
`czynsz` varchar(20) COLLATE utf8_polish_ci DEFAULT 'brak',
`liczba_pokoi` int(2) DEFAULT 0,
`liczba_pieter` int(2) DEFAULT 0,
`adres` varchar(70) COLLATE utf8_polish_ci DEFAULT '',
`miejscowosc` varchar(30) COLLATE utf8_polish_ci DEFAULT '',
`ulica` varchar(100) COLLATE utf8_polish_ci DEFAULT '',
`forma_wlasnosci` varchar(30) COLLATE utf8_polish_ci DEFAULT '',
`rok_budowy` int(4) DEFAULT '0',
`stan` varchar(20) COLLATE utf8_polish_ci DEFAULT 'brak',
`pietro` varchar(10) COLLATE utf8_polish_ci DEFAULT '0',
`ogrzewanie` varchar(15) COLLATE utf8_polish_ci DEFAULT 'brak',
`rodzaj_budynku` varchar(20) COLLATE utf8_polish_ci DEFAULT 'brak',
`material` varchar(10) COLLATE utf8_polish_ci DEFAULT 'brak',
`opis` varchar(4000) COLLATE utf8_polish_ci DEFAULT '',
`url` varchar(100) COLLATE utf8_polish_ci DEFAULT '',
PRIMARY KEY (`id`),
UNIQUE KEY `unik` (`adres`, `url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
*/
namespace Checklist\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\HydratingResultSet;
use Checklist\Model\OfertaEntity;

class OfertaMapper {
	protected $tableName = 'oferty_nieruchomosci';
	protected $dbAdapter;
	protected $sql;

	public function __construct(Adapter $dbAdapter) {
            $this->dbAdapter = $dbAdapter;
            $this->sql = new Sql($dbAdapter);
            $this->sql->setTable($this->tableName);
	}

	public function fetchAll() {
            $select = $this->sql->select();
 		$select->order(array(
 			'id DESC'
 		) );

            $statement = $this->sql->prepareStatementForSqlObject($select);
            $results = $statement->execute();

            $hydrator = new ClassMethods();
            $resultset = new HydratingResultSet($hydrator, new OfertaEntity());
            $resultset->initialize($results);
            return $resultset;
	}

	public function saveOferta(OfertaEntity $oferta) {
            $hydrator = new ClassMethods();
            $data = $hydrator->extract($oferta);
            if ($oferta->getId()) {
                // update action
                $action = $this->sql->update();
                $action->set($data);
                $action->where(array(
                    'id' => $oferta->getId()
                ));
            } else {
                // insert action
                $action = $this->sql->insert();
                unset($data['id']);
                $action->values($data);
            }
            $statement = $this->sql->prepareStatementForSqlObject($action);
            try {
                $result = $statement->execute();                
            } catch (\Exception $exc) {
                return null;
            }
            if (!$oferta->getId()) {
                $oferta->setId($result->getGeneratedValue());
            }
            return $result;
	}

	public function getOferta($id) {
            $select = $this->sql->select();
            $select->where(array(
                'id' => $id
            ));

            $statement = $this->sql->prepareStatementForSqlObject($select);
            $result = $statement->execute()->current();
            if (!$result) {
                return null;
            }

            $hydrator = new ClassMethods();
            $oferta = new OfertaEntity();
            $hydrator->hydrate($result, $oferta);

            return $oferta;
	}

	public function deleteOferta($id) {
            $delete = $this->sql->delete();
            $delete->where(array(
                'id' => $id
            ));

            $statement = $this->sql->prepareStatementForSqlObject($delete);
            return $statement->execute();
	}
        
}