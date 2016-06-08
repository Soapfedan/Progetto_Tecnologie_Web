<?php
class Application_Form_Admin_Buildings_Editfloormap extends App_Form_Abstract
{
    protected $_adminModel;
        
    public function init(){
    }
     
    public function createForm($imm, $fl){
            
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('floorform');
        $this->setAction('');
        
        $validator = new Zend_Validate_Digits();
         
        $this->addElement('file', 'escape_plan', array(
             'label' => 'Cambia il piano di fuga di default', 
             'destination' => '../public/images/escape_plan', 
             'validators' => array( array('Count', false, 1), 
                                    array('Size', false, 102400), 
                                    array('Extension', false, 
                                    array('jpg', 'gif')))
        ));
        
        $this->addElement('text', 'shape', array(
            'label' => 'Forma della mappatura',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'Coordinate', array(
            'label' => 'Coordinate della mappatura',
            'filters' => array('StringTrim'),
            'required' => true,
            'decorators' => $this->elementDecorators,
        ));
        
        $this->addElement('submit','modifica', array(
            'label' => 'modifica',
            'decorators' => $this->buttonDecorators,
        ));

    } 
    
}