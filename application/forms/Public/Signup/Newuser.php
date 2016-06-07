<?php
class Application_Form_Public_Signup_Newuser extends App_Form_Abstract
{
	protected $_userModel;
        
    public function init(){
        
        $this->_userModel = new Application_Model_User();
        $this->setMethod('post');
        $this->setName('newuser');
        $this->setAction('');
        
     
       $this->addElement('text', 'Username', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(5,30))),
            'decorators' => $this->elementDecorators,
        ));
        
      $this->addElement('password', 'Password', array(
            'label' => 'Inserisci la password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(5,30))),
            'decorators' => $this->elementDecorators,
        ));
       
       $this->addElement('password', 'Password', array(
            'label' => 'Ripeti Password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(5,30))),
            'decorators' => $this->elementDecorators,
        )); 
     
      $this->addElement('text', 'Nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(5,30))),
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('text', 'Cognome', array(
            'label' => 'Cognome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(5,30))),
            'decorators' => $this->elementDecorators,
        ));
        
         $this->addElement('text', 'Data_di_Nascita', array(
            'label' => 'Data di nascita  (YYYY-MM-DD)',
            'format' => 'Y-m-d\TH:iP',
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,25))),
            'decorators' => $this->elementDecorators,
        ));
        
       $this->addElement('text', 'Citta', array(
            'label' => 'Città',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,20))),
            'decorators' => $this->elementDecorators,
        ));
        
        $this->addElement('text', 'Provincia', array(
            'label' => 'Provincia',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(2))),
            'decorators' => $this->elementDecorators,
        ));
        
       $this->addElement('select', 'Genere', array(
            'label' => 'Genere',
            'required' => true,
            'multiOptions' => array('M' => 'Maschio', 'F' => 'Femmina'),
            'decorators' => $this->elementDecorators,
        ));
        
        
        $this->addElement('text', 'Codice_fiscale', array(
            'label' => 'Codice Fiscale',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(16))),
            'decorators' => $this->elementDecorators,
        ));
        
        $this->addElement('text', 'Email', array(
            'label' => 'Email',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('EmailAddress'),
            'decorators' => $this->elementDecorators,
        ));
        
       $this->addElement('text', 'Telefono', array(
            'label' => 'Telefono',
            'filters' => array('Digits'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,15))),
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