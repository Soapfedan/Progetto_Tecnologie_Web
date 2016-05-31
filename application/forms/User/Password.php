<?php
class Application_Form_User_Password extends App_Form_Abstract
{
    protected $_userModel;
        
    public function init(){
        
    }
    
    public function createForm($username)
    {
        $this->_userModel = new Application_Model_User();
        $this->setMethod('post');
        $this->setName('passwordform');
        $this->setAction('');
        
        
        $this->addElement('password', 'Password1', array(
            'label' => 'Vecchia password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(5,30))),
            'decorators' => $this->elementDecorators,
        ));
        
        $this->addElement('password', 'Password2', array(
            'label' => 'Vecchia password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(5,30))),
            'decorators' => $this->elementDecorators,
        ));
        
        $this->addElement('password', 'Newpassword', array(
            'label' => 'Nuova password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(5,30))),
            'decorators' => $this->elementDecorators,
        ));
        
        $this->addElement('submit', 'add', array(
            'label' => 'Invia dati',
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