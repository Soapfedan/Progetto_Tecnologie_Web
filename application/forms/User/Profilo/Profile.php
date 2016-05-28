<?php
class Application_Form_User_Profilo_Profile extends App_Form_Abstract
{
	protected $_userModel;
        
    public function init(){
        
    }
    
    public function createForm($completed,$filled,$username)
    {
        $this->_userModel = new Application_Model_User();
        $this->setMethod('post');
        $this->setName('formprofile');
        $this->setAction('');
        
     if($completed==true){ 
       $this->addElement('text', 'Username', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(5,30))),
            'decorators' => $this->elementDecorators,
        ));
        
      $this->addElement('password', 'Password', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(5,30))),
            'decorators' => $this->elementDecorators,
        ));
     } 
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
            'label' => 'Data di nascita',
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
            'validators' => array(array('StringLength',true, array(15))),
            'decorators' => $this->elementDecorators,
        ));
        if($completed==true){
        $this->addElement('select', 'Categoria', array(
            'label' => 'Categoria',            
            'required' => true,
            'multiOptions' => array('1' => 'Utente', '2' => 'Staff','3' => 'Amministratore'),
            'decorators' => $this->elementDecorators,
        ));
        
       $this->addElement('text', 'Societa_staff', array(
            'label' => 'Società Staff',
            'filters' => array('Digits'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1))),
            'decorators' => $this->elementDecorators,
        ));
        }

        if($filled==true){
            $values = $this->_userModel->getUserInformation($username);
            $this->populate($values->toArray());
        }
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