<?php
namespace Checklist\Form;
use Zend\InputFilter\InputFilter;

class OfertaFilter extends InputFilter {
    public function __construct() {
//        $this->add(array(
//            'name' => 'id',
//            'required' => true,
//            'filters' => array(
//                array(
//                    'name' => 'Int'
//                )
//            )
//        ));

        $this->add(array(
            'name' => 'powierzchnia',
            'required' => true,
            'filters' => array (
                array (
                    'name' => 'StripTags'
                ),
                array (
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array (
                array (
                    'name' => 'StringLength',
                    'options' => array (
                        'max' => 10
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'cena',
            'required' => false,
            'filters' => array (
                array('name' => 'StripTags'),
                array('name' => 'StringTrim')
            ),
            'validators' => array (
                array (
                    'name' => 'StringLength',
                    'options' => array (
                        'max' => 12
                    )
                )
            )
        ));
    }
}