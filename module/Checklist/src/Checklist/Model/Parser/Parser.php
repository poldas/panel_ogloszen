<?php
namespace Checklist\Model\Parser;
use Checklist\Model\Parser\ParserSlownik as Slownik;
use Checklist\Model\Parser\ParserTrojmiasto;
use Checklist\Model\Parser\ParserGratka;

class Parser {

    public static $tableData = array();

    public static $rowAmount = 0;

    /**
     *
     * @param array $urls
     * @return array<ParserAbstract>
     */
    public function getParsersArray($urls) {
        $parsery = array ();
        foreach ( $urls as $url ) {
            try {
                $parsery[] = self::getParserByUrl( $url );
            } catch ( Exception $e ) {
            }
        }

        return $parsery;
    }

    /**
     * Pobiera parser i ustawia url parsera
     *
     * @param string $url
     * @return ParserAbstract <ParserTrojmiasto, ParserGratka>
     */
    public static function getParserByUrl($url) {
        $idParser = self::getParserId($url);
        $parser = self::getParserById($idParser);
        $parser->setUrl($url);
        return $parser;
    }

    /**
	 *
	 * @param string $url
	 * @return integer
	 */
	private static function getParserId($url) {
            $idParser = 0;
            if (strrpos ( $url, Slownik::REGEXP_GRATKA ) !== false) {
                $idParser = Slownik::ID_PARSER_GRATKA;
            }

            if (strrpos ( $url, Slownik::REGEXP_TROJMIASTO ) !== false) {
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
				throw new Exception ( $errMsg );
				break;
		}

		return $parser;
	}

//	public static function insertParserData($parser) {
//		$db = new medoo();
//		$cena = $parser->getCena();
//		$cena = preg_replace('/PLN/', '', $cena);
//        $cena = preg_replace('/\s[\s]+/','-', $cena);
//
//        $cena_metr = $parser->getCenaMetr();
//        $cena_metr = substr($cena_metr, 0, strlen($cena_metr) - 1);
//		if ($parser->getPowierzchnia() == "brak") {
//			return;
//		}
//        $dane = array(
//             "id" => null,
//			 "powierzchnia" => strtr($parser->getPowierzchnia()," ", ""),
//			 "cena" => $cena,
//			 "cena_metr" => $cena_metr,
//			 "liczba_pokoi" => $parser->getLiczbaPokoi(),
//			 "adres" => $parser->getAdres(),
//			 "czynsz" => $parser->getCzynsz(),
//			 "rok_budowy" => $parser->getRokBudowy(),
//			 "stan" => $parser->getStan(),
//			 "pietro" => $parser->getPietro(),
//			 "url" => $parser->getUrl(),
//             "data_dodania" => $parser->getDataDodania(),
//		);
//		return $db->insert(ParserSlownik::TABLE_NAME, $dane);
//	}


	private static function setParserData($dane) {
		$parsery = array();
		foreach ($dane as $row) {
			$parser = self::getParserByUrl($row['url']);
			$dataObject = new AdvData();
                        $dataObject->setId($row['id']);
			$dataObject->setAdres($row['adres']);
			$dataObject->setCena(trim($row['cena'], " "));
			$dataObject->setCenaMetr($row['cena_metr']);
			$dataObject->setPowierzchnia(trim($row['powierzchnia'], " "));
			$dataObject->setLiczbaPokoi($row['liczba_pokoi']);
			$dataObject->setCzynsz($row['czynsz']);
			$dataObject->setRokBudowy($row['rok_budowy']);
			$dataObject->setStan($row['stan']);
			$dataObject->setPietro($row['pietro']);
			$dataObject->setUrl($row['url']);

			$parser->setDataObject($dataObject);
			$parsery[] = $parser;
		}

		return $parsery;
	}

    public static function getTotalAmountJson() {
		return self::$rowAmount;
	}


    public static function getRecordsDataJson() {
    	return "";
		self::getDataFromDb();
		return json_encode(self::$tableData);
	}
}

	$urls = array (
//		"http://dom.gratka.pl/tresc/397-46616264-pomorskie-gdansk-wrzeszcz-marynarki-polskiej.html",
//		"http://dom.gratka.pl/tresc/397-51109599-pomorskie-gdansk-wrzeszcz-klonowicza.html",
//		"http://dom.gratka.pl/tresc/397-49228583-pomorskie-pruszcz-gdanski-cedry-male-kolorowa.html",
// 		"http://dom.gratka.pl/tresc/397-50147431-pomorskie-gdansk-mlyniska-twarda.html",
// 		"http://dom.gratka.pl/tresc/397-50195553-pomorskie-gdansk-gdansk-orunia-piaskowa.html",
// 		"http://dom.gratka.pl/tresc/397-49478063-pomorskie-gdansk-wrzeszcz-konrada-wallenroda.html",
// 		"http://dom.gratka.pl/tresc/397-50903871-pomorskie-gdansk-gdansk-siedlce-szara.html",
// 		"http://dom.gratka.pl/tresc/397-50923061-pomorskie-gdansk-wrzeszcz-raclawicka.html",
// 		'http://dom.gratka.pl/tresc/397-51373153-pomorskie-gdansk-siedlce-malczewskiego-jacka.html',
// 		'http://dom.gratka.pl/tresc/397-50493737-pomorskie-gdansk-siedlce-malczewskiego-jacka.html',
// 		'http://dom.gratka.pl/tresc/397-49632097-pomorskie-gdansk-gdansk-siedlce-powstancow-warszawskich.html',
// 		'http://dom.gratka.pl/tresc/397-47131190-pomorskie-gdansk-siedlce-skarpowa.html',
// 		'http://dom.gratka.pl/tresc/397-46750075-pomorskie-gdansk-siedlce-generala-jozefa-bema.html',
// 		'http://dom.gratka.pl/tresc/397-46733323-pomorskie-gdansk-siedlce-malczewskiego.html',
// 		'http://dom.gratka.pl/tresc/397-46303907-pomorskie-gdansk-gdansk-siedlce-kartuska.html',
// 		'http://dom.gratka.pl/tresc/397-49425259-pomorskie-gdansk-siedlce-szara.html',
// 		'http://dom.gratka.pl/tresc/397-46672905-pomorskie-gdansk-gdansk-siedlce-skarpowa.html',
// 		'http://dom.gratka.pl/tresc/397-41611416-pomorskie-gdansk-gdansk-siedlce-skarpowa.html',
// 		'http://dom.gratka.pl/tresc/397-48453491-pomorskie-gdansk-gdansk-siedlce-jozefa-bema.html',
// 		'http://dom.gratka.pl/tresc/397-49164439-pomorskie-gdansk-siedlce-osiedle-focha-powstancow-warszawskich.html',
// 		'http://dom.gratka.pl/tresc/397-49163451-pomorskie-gdansk-siedlce-skarpowa.html',
// 		'http://dom.gratka.pl/tresc/397-49163291-pomorskie-gdansk-siedlce-skarpowa.html',
// 		'http://dom.gratka.pl/tresc/397-49139179-pomorskie-gdansk-siedlce-szara.html',
// 		'http://dom.gratka.pl/tresc/397-49006755-pomorskie-gdansk-siedlce-bema-jozefa.html',
// 		'http://dom.gratka.pl/tresc/397-48529539-pomorskie-gdansk-siedlce-kartuska.html',
 		'http://dom.gratka.pl/tresc/397-48290095-pomorskie-gdansk-siedlce-malczewskiego-jacka.html',
 		'http://dom.gratka.pl/tresc/397-46035384-pomorskie-gdansk-suchanino-czajkowskiego.html',
// 		'http://dom.gratka.pl/tresc/397-41085450-pomorskie-gdansk-siedlce-szara.html',
// 		'http://dom.gratka.pl/tresc/397-43305998-pomorskie-gdansk-siedlce-kartuska.html',
// 		'http://dom.gratka.pl/tresc/397-42940364-pomorskie-gdansk-siedlce-siedlce-kartuska.html',
	// "http://ogloszenia.trojmiasto.pl/nieruchomosci-sprzedam/mieszkanie-gdansk-ogl8379345.html",
		);
//try {
// 	$parseryy = Parser::getParsersArray( $urls );
// 	foreach ($parseryy as $key => $parser) {
//        $parser->parseUrl();
// 		$id = Parser::insertParserData($parser);
// 	}
//	$parsery = Parser::getDataFromDb();
//} catch ( Exception $e ) {
//	echo $e->getMessage ();
//}
?>
