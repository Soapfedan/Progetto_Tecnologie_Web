<?php
class Application_Form_Admin_Faq_Showfaq extends App_Form_Abstract
{
	protected $_adminModel;
        
    public function init(){
    }
     
    public function createForm($faq){
    	$this->setMethod('post');
        $this->setName('faqform');
        $this->setAction('');
		
		$this->addElement('hidden', 'ID');
		/*$this->addElement('textarea', 'ID', array(
                'label' => 'Question',
                'cols' => '60', 'rows' => '2',
                'filters' => array('StringTrim'),
                'required' => true,
                'validators' => array(array('StringLength',true, array(1,2500))),
                'decorators' => $this->elementDecorators,
            ));*/
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
                'label' => 'Modifica',
                'decorators' => $this->buttonDecorators,
                ));
        $this->setAction($this->getView()->url(array(
                    'controller' => 'admin',
                    'action'     => 'editfaq',
                    ), 
                    'default',true
                ));
		$this->populate($faq);
       $this->setDecorators(array(
           'FormElements',
           array('HtmlTag', array('tag' => 'table')),
           array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
           'Form'
       )); 
    }


}