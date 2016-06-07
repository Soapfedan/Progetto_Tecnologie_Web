<?php
class Application_Form_Admin_Buildings_Editfloormap extends App_Form_Abstract
{
    protected $_adminModel;
        
    public function init(){
    }
     
    public function createForm($imm, $fl){
            
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('floorform');
        $this->setAction('');
         
        $this->addElement('file', 'map', array(
             'label' => 'Cambia la mappa del piano', 
             'destination' => '../public/images/map', 
             'validators' => array( array('Count', false, 1), 
                                    array('Size', false, 102400), 
                                    array('Extension', false, 
                                    array('jpg', 'gif')))
        ));
        
        $this->addElement('submit','modifica', array(
            'label' => 'hh',
            'decorators' => $this->buttonDecorators,
        ));
        
        
        /*
        $values = $this->_adminModel->getAllZones($imm, $fl);
        $valuearr = $values->toArray();
            // Crea un radioButton
        $radio = new Zend_Form_Element_Radio('zones');
            // Cicla sulla lista di piani e aggiunge l'opzione relativa al radioButton
        foreach($valuearr as $zone){
            $radio->addMultiOption($zone['Zona'], 'Zona '.$zone['Zona']);
        }
            // Aggiunge il radioButton finale alla form
        $this->addElement($radio);
                
        $this->addElement('submit','modifica', array(
            'label' => 'modifica',
            'decorators' => $this->buttonDecorators,
        ));
        $this->addElement('submit','elimina', array(
            'label' => 'elimina',
            'decorators' => $this->buttonDecorators,
        ));
        */
    } 
    
}