<?php
class Application_Form_Admin_Faq_Showfaq extends App_Form_Abstract
{
	protected $_adminModel;
        
    public function init(){
        
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('faqform');
        $this->setAction('');
        $values = $this->_adminModel->extractFaq();
        
        $subforms = array();
       
        $valuarr = $values->toArray();
        $i=0;
        foreach ($valuarr as $faq) {
          $i=$i+1;
            $subform = new Zend_Form_SubForm($i);
            
             $subform->addElement('text', 'ID', array(
            'label' => 'ID',
            'decorators' => $this->elementDecorators,
        ));
            
            $subform->addElement('textarea', 'Question', array(
            'label' => 'Question',
            'cols' => '60', 'rows' => '2',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
            'decorators' => $this->elementDecorators,
            ));
        
            $subform->addElement('textarea', 'Answer', array(
            'label' => 'Answer',
            'cols' => '60', 'rows' => '2',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2500))),
            'decorators' => $this->elementDecorators,
        ));
             $subform->addElement('button','Modifica',array(
             'label' => 'Modifica'
             ));
             
             $subform->addElement('button','Cancella',array(
             'label' => 'Cancella'
             ));
             
     
        
             $subform->populate($faq);
             $this->addSubForm($subform,'subform'.$i);
            
             }
            
            
            
       
    }


}