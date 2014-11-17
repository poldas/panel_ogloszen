<?php
namespace Checklist\Model\Parser;
class ParserSlownik {
    const ID_PARSER_TROJMIASTO = 1;
    const ID_PARSER_GRATKA = 2;

    const REGEXP_GRATKA = "dom.gratka.pl";
    const REGEXP_TROJMIASTO = "trojmiasto.pl";

    const DATABASE_NAME = "oferty";
    const TABLE_NAME = "oferty_nieruchomosci";

    /**
     * Dostępne pola w formularzu
     *
     * @var string
     */
    const FIELD_RECID = "recid";
    const FIELD_CENA = "cena";
    const FIELD_ADRES = "adres";
    const FIELD_POKOJE = "pokoje";
    const FIELD_POWIERZCHNIA = "powierzchnia";
    const FIELD_ROK = "rokbudowy";
    const FIELD_DATE = "sdate";
    
    const GMAPS_ICO = "http://maps.google.com/mapfiles/kml/pal3/icon";
    const GMAPS_ICO_1 = "http://maps.google.com/mapfiles/kml/pal3/icon0.png";
    const GMAPS_ICO_2 = "http://maps.google.com/mapfiles/kml/pal3/icon1.png";
    const GMAPS_ICO_3 = "http://maps.google.com/mapfiles/kml/pal3/icon2.png";
    const GMAPS_ICO_4 = "http://maps.google.com/mapfiles/kml/pal3/icon3.png";
    const GMAPS_ICO_DEF = "";
    
    const LABEL_CENA = 'cena';
    const LABEL_CENA_ZA_M2 = 'cenam2';
    const LABEL_RODZAJ = 'rodzaj';
    const LABEL_POWIERZCHNIA = 'powierzchnia';
    const LABEL_LICZBA_POKOI = 'liczba_pokoi';
    const LABEL_ROK_BUDOWY = "rok_budowy";
    const LABEL_ULICA = "ulica";
    const LABEL_DZIELNICA = "dzielnica";
    const LABEL_MIEJSCOWOSC = "miejscowosc";
    const LABEL_ADRES = "adres";
    const LABEL_PIETRO = "pietro";
    const LABEL_LICZBA_PIETER = "liczba_pieter";
    const LABEL_OPIS = "opis";
    const LABEL_INFO_DODATKOWE = "informacjedodatkowe";
    const LABEL_FORMA_WLASN = "forma_wlasnosci";
    const LABEL_TYP_BUDYNKU = "rodzaj_budynku";
    const LABEL_MATERIAL = "material";
    const LABEL_OGRZEWANIE = "ogrzewanie";
    const LABEL_STAN_MIESZKANIA = "stan";
    
    public static function pobierz_dostepne_parsery() {
        return array(
            self::ID_PARSER_TROJMIASTO,
            self::ID_PARSER_GRATKA,
        );
    }

    public static $labele = array(
        'rodzaj' => self::LABEL_RODZAJ,
        'typbudynku' => self::LABEL_TYP_BUDYNKU,
        'material' => self::LABEL_MATERIAL,
        'cena' => self::LABEL_CENA,
        'cenazam2' => self::LABEL_CENA_ZA_M2,
        'cenam2' => self::LABEL_CENA_ZA_M2,
        'powierzchnia' => self::LABEL_POWIERZCHNIA,
        'miasto' => self::LABEL_MIEJSCOWOSC,
        'miejscowosc' => self::LABEL_MIEJSCOWOSC,
        'pietro' => self::LABEL_PIETRO,
        'liczbakondygnacji' => self::LABEL_LICZBA_PIETER,
        'liczbapieter' => self::LABEL_LICZBA_PIETER,
        'pietro' => self::LABEL_PIETRO,
        'dzielnica' => self::LABEL_DZIELNICA,
        'ulica' => self::LABEL_ULICA,
        'ulicainr' => self::LABEL_ULICA,
        'liczbapokoi' => self::LABEL_LICZBA_POKOI,
        'liczba_pokoi' => self::LABEL_LICZBA_POKOI,
        'rokbudowy' => self::LABEL_ROK_BUDOWY,
        'rok_budowy' => self::LABEL_ROK_BUDOWY,
        'rodzaj' => self::LABEL_RODZAJ,
        'opis' => self::LABEL_OPIS,
        'informacjedodatkowe' => self::LABEL_OPIS,
        'typogrzewania' => self::LABEL_OGRZEWANIE,
        'formawlasnosci' => self::LABEL_FORMA_WLASN,
        'stanmieszkania' => self::LABEL_STAN_MIESZKANIA,
    );

    /**
     * Zwraca przemapowaną nazwę labela.
     * 
     * @param string $pattern
     * @return string
     */
    public static function getLabelName($pattern) {
        $tmp = self::przygotuj($pattern);
        if (isset(self::$labele[$tmp])) {
            return self::$labele[$tmp];
        }
        
        return '';
    }

    private static function przygotuj($wzorzec){
        $polish = array('ą', 'ę', 'ś', 'ć', 'ż', 'ź', 'ó', 'ł', 'ń', 'Ą', 'Ę', 'Ś', 'Ć', 'Ż', 'Ź', 'Ó', 'Ł', 'Ń', ' ');
        $replace = array('a', 'e', 's', 'c', 'z', 'z', 'o', 'l', 'n', 'A', 'E', 'S', 'C', 'Z', 'Z', 'O', 'L', 'N', '');
        return str_replace($polish, $replace, strtolower(trim($wzorzec)));
    }
	protected function subString($string, $length) {
		$tmp = trim($string);
                $subs = substr($tmp, $length);
		return trim($subs);
	}
        
	public function getIconUrl() {
		$liczbaPokoi = 1;
		switch ($liczbaPokoi) {
			case 1:
				$ico = self::GMAPS_ICO_1;
			break;
			case 2:
				$ico = self::GMAPS_ICO_2;
			break;
			case 3:
				$ico = self::GMAPS_ICO_3;
			break;
			case 4:
				$ico = self::GMAPS_ICO_4;
			break;
			default:
				$ico = self::GMAPS_ICO_DEF;
			break;
		}
		return $ico;
	}
        
    public static function getColumnsDataJson() {
	    $columns = array(
	        array("field" => self::FIELD_RECID,
	            "caption" => 'ID',
	            "size" => '35px',
	            "searchable" => 'int',
	            "sortable" => true,
	            "resizable" => true,
	        ),
	        array("field" => self::FIELD_CENA,
	            "caption" => 'Cena',
	            "size" => '100px',
	            "searchable" => 'int',
	            "sortable" => true,
	            "resizable" => true,
	        ),
    		array("field" => self::FIELD_ADRES,
    			"caption" => 'Adres',
    			"size" => '300px',
    			"searchable" => 'text',
    			"sortable" => true,
    			"resizable" => true,
    		),
	        array("field" => self::FIELD_POKOJE,
	            "caption" => 'Pokoje',
	            "size" => '60px',
	            "searchable" => 'text',
	            "sortable" => true,
	            "resizable" => true,
	        ),
	        array("field" => self::FIELD_POWIERZCHNIA,
	            "caption" => 'Powierzchnia',
	            "size" => '100px',
	            "searchable" => 'text',
	            "sortable" => true,
	            "resizable" => true,
	        ),
	        array("field" => self::FIELD_ROK,
	            "caption" => 'Rok budowy',
	            "size" => '100px',
	            "searchable" => 'text',
	            "sortable" => true,
	            "resizable" => true,
	        ),
	        array("field" => self::FIELD_DATE,
	            "caption" => 'Data dodania',
	            "size" => '120px',
	            "searchable" => 'text',
	            "sortable" => true,
	            "resizable" => true,
	        )
	    );
	    return json_encode($columns);
    }

    public static function getSearchesDataJson() {
	    $columns = array(
	        array("field" => 'cena',
	            "caption" => 'Cena',
	            "type" => 'text',
	        ),
	    	array("field" => 'adres',
	    		"caption" => 'Adres',
	    		"type" => 'text',
	    	),
	        array("field" => 'liczbaPokoi',
	            "caption" => 'Liczba pokoi',
	            "type" => 'text',
	        ),
	        array("field" => 'powierzchnia',
	            "caption" => 'Powierzchnia',
	            "type" => 'text',
	        ),
	        array("field" => 'rokBudowy',
	            "caption" => 'Rok budowy',
	            "type" => 'text',
	        ),
	        array("field" => 'sdate',
	            "caption" => 'Data dodania',
	            "type" => 'text',
	        )
	    );
	    return json_encode($columns);
    }

    public static function getSortDataJson() {
	    $columns = array(
	        array("field" => 'cena',
	            "direction" => 'DESC',
	        ),
	    	array("field" => 'adres',
	    		"direction" => 'DESC',
	    	),
	        array("field" => 'liczbaPokoi',
	            "direction" => 'DESC',
	        ),
	        array("field" => 'powierzchnia',
	            "direction" => 'DESC',
	        ),
	        array("field" => 'rokBudowy',
	            "direction" => 'DESC',
	        ),
	        array("field" => 'sdate',
	            "direction" => 'DESC',
	        )
	    );
	    return json_encode($columns);
    }
}
?>