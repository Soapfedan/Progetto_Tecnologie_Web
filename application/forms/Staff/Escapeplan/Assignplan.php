<?php
class Application_Form_Staff_Escapeplan_Assignplan extends App_Form_Abstract
{
	
    
    public function init(){

           	
        $this->setMethod('post');
        $this->setName('assignplan');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');

        

        $this->addElement('file', 'Piano_di_fuga_alternativo', array(
        	'label' => 'Piano di fuga da caricare',
        	'destination' => APPLICATION_PATH . '/../public/images/escape_plan',
        	'validators' => array( 
        			array('Count', false, 1),
        			array('Size', false, 102400),
        			array('Extension', false, array('jpg', 'png'))),
            'decorators' => $this->fileDecorators,
        			));
               
       

        $this->addElement('submit', 'Assegna', array(
            'label' => 'Assegna percorso',
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