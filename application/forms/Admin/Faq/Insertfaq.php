<?php
class Application_Form_Admin_Faq_Insertfaq extends App_Form_Abstract
{
	protected $_adminModel;
        
    public function init(){
            
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('insertfaqform');
        $this->setAction('');
            
        $this->addElement('textarea', 'Question', array(
            'label' => 'Question',
            'cols' => '60', 'rows' => '2',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('textarea', 'Answer', array(
            'label' => 'Answer',
            'cols' => '60', 'rows' => '2',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
            'decorators' => $this->elementDecorators,
        ));
    
        $this->addElement('submit','Modifica',array(
                'label' => 'Inserisci',
                'decorators' => $this->buttonDecorators,
            ));
        
        $this->setAction($this->getView()->url(array(
                'controller' => 'admin',
                'action'     => 'insertfaq'
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
    

}