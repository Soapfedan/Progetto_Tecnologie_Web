<?php
class Application_Form_Admin_Buildings_Buildingparam extends App_Form_Abstract
{
    protected $_adminModel;
        
    public function init(){
    }
     
    public function createForm($imm = null){
            
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('editbuildparamform');
        $this->setAction('');
        
            
        $this->addElement('text', 'Nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'Citta', array(
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
        $this->addElement('text', 'Societa', array(
            'label' => 'Società',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('submit', $imm == null ? 'aggiungi' : 'modifica', array(
            'label' => $imm == null ? 'aggiungi' : 'modifica',
            'decorators' => $this->buttonDecorators,
        ));
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
            
        if($imm){
            $values = $this->_adminModel->getBuilding($imm);
            $valuearr = $values->toArray();
            
            $this->populate($valuearr);
            
        }  
    }

}