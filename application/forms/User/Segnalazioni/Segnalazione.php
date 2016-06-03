<?php
class Application_Form_User_Segnalazioni_Segnalazione extends App_Form_Abstract
{
	protected $_userModel;
        
    public function init(){
	}
	
    public function create($immobile, $piano){        
        $this->_userModel = new Application_Model_User();
        $this->setMethod('post');
        $this->setName('sendalertform');
        $this->setAction('');
		
			$valuesZone =$this->_userModel->getAllZone($immobile,$piano);
			$valuesDisaster = $this->_userModel->extractDisaster();
			$optionsZone = array();
			$optionsDisaster = array();  
			$i=1;
			foreach ($valuesZone as $zone){
				$optionsZone[$i] = $zone['Zona'];
				$i++;
			}
			$i=1;
			foreach ($valuesDisaster as $disaster){
				$optionsDisaster[$i] = $disaster['Descrizione'];
				$i++;
			}
			$select = new Zend_Form_Element_Select('zona');
			$select->setMultiOptions($optionsZone);
			$select->setLabel('Zona da segnalare');
			$selectDisaster = new Zend_Form_Element_Select('disastro');
			$selectDisaster->setMultiOptions($optionsDisaster);
			$selectDisaster->setLabel('Evento da segnalare');
            
            $this->addElement($select);
			$this->addElement($selectDisaster);
			
        
            $this->addElement('submit','Modifica',array(
                    'label' => 'Inserisci',
                    'decorators' => $this->buttonDecorators,
                ));
            
           $this->setAction($this->getView()->url(array(
                    'controller' => 'user',
                    'action'     => 'sendalert',
                    'immobile'   => $immobile,
                    'floor'      => $piano
                    ), 
                    'default',true
                ));
		
       $this->setDecorators(array(
           'FormElements',
           array('HtmlTag', array('tag' => 'table')),
           array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
           'Form'
       ));
	   
       } 
/*
$result = $model->fetchAll()->toArray();
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