<?php
class Application_Form_Admin_Buildings_Editbuilding extends App_Form_Abstract
{
    protected $_adminModel;
        
    public function init(){
    }
     
    public function createInsertPlanForm(){
            
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('editbuildform');
        $this->setAction('');
         
        $this->addElement('text', 'plan_id', array(
            'label' => 'Id del piano',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('Digits')),
            'decorators' => $this->elementDecorators,
        ));
    }

}