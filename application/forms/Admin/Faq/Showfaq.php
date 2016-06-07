<?php
class Application_Form_Admin_Faq_Showfaq extends App_Form_Abstract
{
	protected $_adminModel;
        
    public function init(){
    }
     
    public function createForm($edit){
        /*    
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('faqform');
        $this->setAction('');
            // Estrae tutte le righe della tabella faq.
        $values = $this->_adminModel->extractFaq();
            // Formatta tutto in un array.
            
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
        
                // Se si è in modalità Modifica.
            if($edit == true){
                $subform->addElement('submit','Modifica',array(
                    'label' => 'Modifica',
                    'decorators' => $this->buttonDecorators,
                ));
                $subform->setAction($this->getView()->url(array(
                    'controller' => 'admin',
                    'action'     => 'editfaq',
                    'idfaq'      => $faq['ID'],
                    'subform'    => 'subform'.$i,
                    'edit'       => true
                    ), 
                    'default',true
                ));
                $subform->setMethod('post');
            }
                // Se si è in modalità Elimina.
            else{
                $subform->addElement('submit','Cancella',array(
                'label' => 'Cancella',
                'decorators' => $this->buttonDecorators,
                ));
                $subform->setAction($this->getView()->url(array(
                    'controller' => 'admin',
                    'action'     => 'deletefaq',
                    'idfaq'      => $faq['ID'],
                    'subform'    => 'subform'.$i
                    ), 
                    'default',true
                ));
                $subform->setMethod('post');
            }
    
            $subform->populate($faq);
            $this->addSubForm($subform,'subform'.$i);
            $subform->setDecorators(array(
                'FormElements',
                array('HtmlTag', array('tag' => 'dl',
                    'class' => 'zend_form')),
                array('Description', array('placement' => 'prepend', 'class' => 'formerror')),                                   
                'Form',
            )); */
		
       $this->setDecorators(array(
           'FormElements',
           array('HtmlTag', array('tag' => 'table')),
           array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
           'Form'
       )); 
    }


}