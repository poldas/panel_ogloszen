<?php
namespace Checklist\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;
use Checklist\Form\OfertaFilter;

class OfertaForm extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct('oferta');

        $this->setAttribute('method', 'post');
        $this->setInputFilter(new OfertaFilter());
        $this->setHydrator(new ClassMethods());

        $this->add(array(
            'name' => 'id',
            'type' => 'hidden',
        ));

        $this->add(array(
            'name' => 'cena',
            'type' => 'text',
            'options' => array(
                'label' => 'Cena',
            ),
            'attributes' => array(
                'id' => 'cena',
                'maxlength' => 10,
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'cenam2',
            'type' => 'text',
            'options' => array(
                'label' => 'Cena za m2',
            ),
            'attributes' => array(
                'id' => 'cenam2',
                'maxlength' => 10,
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'powierzchnia',
            'type' => 'text',
            'options' => array(
                'label' => 'Powierzchnia',
            ),
            'attributes' => array(
                'id' => 'powierzchnia',
                'maxlength' => 80,
                'class' => 'form-control',
                "autofocus" => "autofocus",
            )
        ));

        $this->add(array(
            'name' => 'czynsz',
            'type' => 'text',
            'options' => array(
                'label' => 'Czynsz',
            ),
            'attributes' => array(
                'id' => 'czynsz',
                'maxlength' => 80,
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'liczba_pokoi',
            'type' => 'text',
            'options' => array(
                'label' => 'Liczba Pokoi',
            ),
            'attributes' => array(
                'id' => 'liczba_pokoi',
                'maxlength' => 80,
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'opis',
            'type' => 'textarea',
            'options' => array(
                'label' => 'Opis',
            ),
            'attributes' => array(
                'id' => 'opis',
                'class' => 'form-control',
                'rows' => 15,
            )
        ));
                
        $this->add(array(
            'name' => 'adres',
            'type' => 'text',
            'options' => array(
                'label' => 'Adres',
            ),
            'attributes' => array(
                'id' => 'adres',
                'maxlength' => 80,
                'class' => 'form-control',
            )
        ));


        $this->add(array(
            'name' => 'miejscowosc',
            'type' => 'text',
            'options' => array(
                'label' => 'Miejscowość',
            ),
            'attributes' => array(
                'id' => 'miejscowosc',
                'maxlength' => 80,
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'dzielnica',
            'type' => 'text',
            'options' => array(
                'label' => 'Dzielnica',
            ),
            'attributes' => array(
                'id' => 'dzielnica',
                'maxlength' => 80,
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'ulica',
            'type' => 'text',
            'options' => array(
                'label' => 'Ulica',
            ),
            'attributes' => array(
                'id' => 'ulica',
                'maxlength' => 80,
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'rok_budowy',
            'type' => 'text',
            'options' => array(
                'label' => 'Rok budowy',
            ),
            'attributes' => array(
                'id' => 'rokBudowy',
                'maxlength' => 80,
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'stan',
            'type' => 'text',
            'options' => array(
                'label' => 'Stan mieszkania',
            ),
            'attributes' => array(
                'id' => 'stanMieszkania',
                'maxlength' => 80,
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'pietro',
            'type' => 'text',
            'options' => array(
                'label' => 'Pietro',
            ),
            'attributes' => array(
                'id' => 'pietro',
                'maxlength' => 80,
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'rodzaj_budynku',
            'type' => 'text',
            'options' => array(
                'label' => 'Rodzaj budynku',
            ),
            'attributes' => array(
                'id' => 'rodzajBudynku',
                'maxlength' => 80,
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'ogrzewanie',
            'type' => 'text',
            'options' => array(
                'label' => 'Ogrzewanie',
            ),
            'attributes' => array(
                'id' => 'ogrzewanie',
                'maxlength' => 80,
                'class' => 'form-control',
            )
        ));

        $this->add(array(
            'name' => 'url',
            'type' => 'text',
            'options' => array(
                'label' => 'Url',
            ),
            'attributes' => array(
                'id' => 'url-ogloszenia',
                'maxlength' => 100,
                'class' => 'form-control',
            )
        ));
        
        $this->add(array(
            'name' => 'material',
            'type' => 'text',
            'options' => array(
                'label' => 'Materiał',
            ),
            'attributes' => array(
                'id' => 'material',
                'maxlength' => 30,
                'class' => 'form-control',
            )
        ));
 
        $this->add(array(
            'name' => 'forma_wlasnosci',
            'type' => 'text',
            'options' => array(
                'label' => 'Forma Wł.',
            ),
            'attributes' => array(
                'id' => 'forma-wlasnosci',
                'maxlength' => 40,
                'class' => 'form-control',
            )
        ));
        
        $this->add(array(
            'name' => 'liczba_pieter',
            'type' => 'text',
            'options' => array(
                'label' => 'Liczba pięter',
            ),
            'attributes' => array(
                'id' => 'liczba-pieter',
                'maxlength' => 3,
                'class' => 'form-control',
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'class' => 'btn btn-primary',
            ),
        ));

        $this->add(array(
            'name' => 'wroc',
            'attributes' => array(
                'type'  => 'button',
                'value' => 'Wróć',
                'class' => 'btn btn-default',
                'onclick' => 'javascript: window.history.back();'
            ),
        ));
    }
}