<?php
class Application_Form_Admin_Buildings_Showbuildings extends App_Form_Abstract
{
	protected $_adminModel;
        
    public function init(){
    }
     
    public function createForm(){
            
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('buildform');
        $this->setAction('');
            
        $values = $this->_adminModel->getAllBuildings();
        $valuearr = $values->toArray();
            // Crea un radioButton
        $radio = new Zend_Form_Element_Radio('imms');
            // Cicla sulla lista di immobili e aggiunge l'opzione relativa al radioButton
        foreach($valuearr as $imm){
            $radio->addMultiOption($imm['Id'], 'Immobile '.$imm['Id']);
        }
        $radio->setValue($valuearr[0]);
        $radio->setRequired();
            // Aggiunge il radioButton finale alla form
        $this->addElement($radio);
        
        $this->addElement('submit','aggiungi', array(
            'label' => 'aggiungi',
            'decorators' => $this->buttonDecorators,
        ));        
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