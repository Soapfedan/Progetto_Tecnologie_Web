<?php
class Application_Form_Staff_Evacuation_Insertalert extends App_Form_Abstract
{
   
        
    public function init(){
	}
           
    public function create($immobili,$disaster){        
        $this->setMethod('post');
        $this->setName('sendalertform');
        $this->setAction('');
		
			
			$optionsimm = array();
			 $option = array();
             $optalert = array();
             
             $optalert[]='--Select--';
             $optionsimm[]='';
             $option[]='';
			
			foreach ($immobili as $i){
				$optionsimm[$i] = $i;
				
			}
            
            foreach ($disaster as $i){
                $optalert[] = $i;
                
            }
			
			$select = new Zend_Form_Element_Select('Immobile');
			$select->setMultiOptions($optionsimm);
			$select->setLabel('Immobile');
			
            $this->addElement($select);
			
			$select1 = new Zend_Form_Element_Select('Id_Piano');
            $select1->setLabel('Piano');
            $select1->setRegisterInArrayValidator(false);
            $select1->setMultiOptions($option);
            $this->addElement($select1);
            
            $select2 = new Zend_Form_Element_Select('Codice_Zona');
            $select2->setLabel('Zona');
            $select2->setRegisterInArrayValidator(false);
            $select2->setMultiOptions($option);
            $this->addElement($select2);
            
            $select3 = new Zend_Form_Element_Select('Tipo_Catastrofe');
            $select3->setLabel('Piano');
            $select3->setMultiOptions($optalert);
            $this->addElement($select3);
            
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