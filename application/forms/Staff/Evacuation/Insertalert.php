<?php
class Application_Form_Staff_Evacuation_Insertalert extends App_Form_Abstract
{
   
        
    public function init(){
	}
           
    public function create($immobili){        
        $this->setMethod('post');
        $this->setName('sendalertform');
        $this->setAction('');
		
			
			$optionsimm = array();
			 
             $optionsimm[]='--Select--';
			
			foreach ($immobili as $i){
				$optionsimm[] = $i;
				
			}
			
			$select = new Zend_Form_Element_Select('Immobile');
			$select->setMultiOptions($optionsimm);
			$select->setLabel('Immobile');
			
            $this->addElement($select);
			
			
        
            $this->addElement('submit','Inserisci',array(
                    'label' => 'Inserisci',
                    'decorators' => $this->buttonDecorators,
                ));
            
           
		
       $this->setDecorators(array(
           'FormElements',
           array('HtmlTag', array('tag' => 'table')),
           array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
           'Form'
       ));
	   
       } 


}