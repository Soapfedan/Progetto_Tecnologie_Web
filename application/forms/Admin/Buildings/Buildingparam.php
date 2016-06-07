<?php
class Application_Form_Admin_Buildings_Buildingparam extends App_Form_Abstract
{
    protected $_adminModel;
        
    public function init(){
    }
     
    public function createForm($imm){
            
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('editbuildparamform');
        $this->setAction('');
        
        if($imm){
            
            $this->addElement('text', 'Nome', array(
                'label' => 'Nome',
                'filters' => array('StringTrim'),
                'required' => true,
                'validators' => array(array('StringLength',true, array(1,2500))),
                'decorators' => $this->elementDecorators,
            ));
            $this->addElement('text', 'Città', array(
                'label' => 'Città',
                'filters' => array('StringTrim'),
                'required' => true,
                'validators' => array(array('StringLength',true, array(1,2500))),
                'decorators' => $this->elementDecorators,
            ));
            $this->addElement('text', 'Provincia', array(
                'label' => 'Provincia',
                'filters' => array('StringTrim'),
                'required' => true,
                'validators' => array(array('StringLength',true, array(1,2500))),
                'decorators' => $this->elementDecorators,
            ));
            $this->addElement('text', 'Via', array(
                'label' => 'Via',
                'filters' => array('StringTrim'),
                'required' => true,
                'validators' => array(array('StringLength',true, array(1,2500))),
                'decorators' => $this->elementDecorators,
            ));
            $this->addElement('submit','modifica', array(
                'label' => 'modifica',
                'decorators' => $this->buttonDecorators,
            ));
            /*
            $values = $this->_adminModel->getBuilding($imm);
            $valuearr = $values->toArray();
            
            $this->populate($valuearr);*/
            /*
                // Crea un radioButton
            $radio = new Zend_Form_Element_Radio('floors');
                // Cicla sulla lista di piani e aggiunge l'opzione relativa al radioButton
            foreach($valuearr as $floor){
                $radio->addMultiOption($floor['Id_piano'], 'Piano '.$floor['Id_piano']);
            }
                // Aggiunge il radioButton finale alla form
            $this->addElement($radio);
            
            $this->addElement('submit','inserisci', array(
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
            )); */
        }  
    }

}