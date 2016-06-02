<?php
class Application_Form_User_Segnalazioni_Segnalazione extends App_Form_Abstract
{
	protected $_userModel;
        
    public function init(){
	}
	
    public function create($immobile, $piano){        
        $this->_userModel = new Application_Model_User();
        $this->setMethod('post');
        $this->setName('formsegnalazione');
        $this->setAction('');
		
			$values =$this->_userModel->getAllZone($immobile,$piano);       
			$selettore = new Zend_Form_Element_Select('zone');
			//$selettore->setMultiOptions($values);
				
			
			
			
			
            $this->addElement($selettore);
        
            $this->addElement('submit','Modifica',array(
                    'label' => 'Inserisci',
                    'decorators' => $this->buttonDecorators,
                ));
            
           /* $this->setAction($this->getView()->url(array(
                    'controller' => 'user',
                    'action'     => '' //da fare
                    ), 
                    'default',true
                ));*/
		
       $this->setDecorators(array(
           'FormElements',
           array('HtmlTag', array('tag' => 'table')),
           array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
           'Form'
       ));
	   
       } 
/*
 * 
 * 
 * $result = $model->fetchAll()->toArray();
$options = array();

foreach ($result as $value) {
    $options[$value['id']] = $value['whatEver'];
}

$field = new Zend_Form_Element_Select();
$field->setMultiOptions($options);
 * 
 * 
 * 
 * 
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('buildform');
        $this->setAction('');
            
        $values = $this->_adminModel->getAllBuildings();
        $valuearr = $values->toArray();
            // Crea un radioButton
        $radio = new Zend_Form_Element_Radio('imms');
            // Cicla sulla lista di immobile e aggiunge l'opzione relativa al radioButton
        foreach($valuearr as $imm){
            $radio->addMultiOption($imm['Immobile'], 'Immobile '.$imm['Immobile']);
        }
            // Aggiunge il radioButton finale alla form
        $this->addElement($radio);
        
        $this->addElement('submit','Modifica', array(
            'label' => 'Modifica',
            'decorators' => $this->buttonDecorators,
        ));
 */
    

}