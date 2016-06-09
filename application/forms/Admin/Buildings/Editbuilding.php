<?php
class Application_Form_Admin_Buildings_Editbuilding extends App_Form_Abstract
{
    protected $_adminModel;
        
    public function init(){
    }
     
    public function createForm($imm){
            
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('editbuildform');
        $this->setAction('');
        
        if($imm){
            $values = $this->_adminModel->getFloors($imm);
            $valuearr = $values->toArray();
                // Crea un radioButton
            $radio = new Zend_Form_Element_Radio('floors');
                // Cicla sulla lista di piani e aggiunge l'opzione relativa al radioButton
            foreach($valuearr as $floor){
                $radio->addMultiOption($floor['Id_piano'], 'Piano '.$floor['Id_piano']);
            }
            // Se l'immobile non ha piani
            if($valuearr)
                $radio->setValue($valuearr[0]);
            $radio->setRequired();
                // Aggiunge il radioButton finale alla form
            $this->addElement($radio);
            
            $this->addElement('submit','aggiungi', array(
                'label' => 'aggiungi',
                'decorators' => $this->buttonDecorators,
            ));  
            // Non crea i pulsanti modifica ed elimina se l'immobile non ha ancora alcun piano
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