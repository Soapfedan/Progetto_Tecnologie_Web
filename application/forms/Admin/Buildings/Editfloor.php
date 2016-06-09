<?php
class Application_Form_Admin_Buildings_Editfloor extends App_Form_Abstract
{
    protected $_adminModel;
        
    public function init(){
    }
     
    public function createForm($imm, $fl){
        
        if($fl){    
            $this->_adminModel = new Application_Model_Admin();
            $this->setMethod('post');
            $this->setName('editfloorform');
            $this->setAction('');
            
            $values = $this->_adminModel->getAllZones($imm, $fl);
            $valuearr = $values->toArray();
                // Crea un radioButton
            $radio = new Zend_Form_Element_Radio('zone');
                // Cicla sulla lista di piani e aggiunge l'opzione relativa al radioButton
            foreach($valuearr as $zone){
                $radio->addMultiOption($zone['Zona'], 'Zona '.$zone['Zona']);
            }
            if($valuearr)
                $radio->setValue($valuearr[0]);
            $radio->setRequired();
                // Aggiunge il radioButton finale alla form
            $this->addElement($radio);
            
            $this->addElement('submit','aggiungi', array(
                'label' => 'aggiungi',
                'decorators' => $this->buttonDecorators,
            ));  
            if($valuearr){      
                $this->addElement('submit','modifica', array(
                    'label' => 'modifica',
                    'decorators' => $this->buttonDecorators,
                ));
                $this->addElement('submit','elimina', array(
                    'label' => 'elimina',
                    'decorators' => $this->buttonDecorators,
                )); 
            }
        }
    }

}