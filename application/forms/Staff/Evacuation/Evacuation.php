<?php
class Application_Form_Staff_Evacuation_Evacuation extends App_Form_Abstract
{
   
        
    public function init(){
           
        
        $this->setMethod('post');
        $this->setName('evacform');
        $this->setAction('');
            
        $select = new Zend_Form_Element_Select('Societa');
        $select->addMultiOptions(array(
                    '0'=>'0',
                    '1'=>'1'
                    
        ));
        $this->addElement($select);
        
        $select1 = new Zend_Form_Element_Select('Immobili');
        $select1->addMultiOptions(array(
                    'select'=>'[select]',
                    
                    
        ));
        $this->addElement($select1);
        $select->setAttrib('onchange','autoFill()');  
            
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