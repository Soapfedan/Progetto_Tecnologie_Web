<?php
class Application_Form_Staff_Evacuation extends App_Form_Abstract
{
    protected $_staffModel;
        
    public function init(){
    }
     
    public function createForm($society){
            
        $this->_staffModel = new Application_Model_Staff();
        $this->setMethod('post');
        $this->setName('evacform');
        $this->setAction('');
            
        $values = $this->_staffModel->getImms($society);    
            
            
         /*   
        $values = $this->_adminModel->getAllBuildings();
        $valuearr = $values->toArray();
            // Crea un radioButton
        $radio = new Zend_Form_Element_Radio('imms');
            // Cicla sulla lista di immobili e aggiunge l'opzione relativa al radioButton
        foreach($valuearr as $imm){
            $radio->addMultiOption($imm['Immobile'], 'Immobile '.$imm['Immobile']);
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
        ));   */
    }


}