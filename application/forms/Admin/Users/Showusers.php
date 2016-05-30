<?php
class Application_Form_Admin_Users_Showusers extends App_Form_Abstract
{
	protected $_adminModel;
        
    public function init(){
    }
     
    public function createForm($edit){
            
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('usersform');
        $this->setAction('');
            // Estrae tutte le righe della tabella users.
        $values = $this->_adminModel->getAllUsers();
            // Formatta tutto in un array.
        $valuarr = $values->toArray();
        $i = 0;
        foreach ($valuarr as $user) {
          $i = $i + 1;
                // Crea una subform per ogni riga della tabella delle faq.
            $subform = new Zend_Form_SubForm($i);
          
                // Se si è in modalità Modifica.
            if($edit == true){
                $subform->addElement('submit','Modifica',array(
                    'label' => 'Modifica',
                    'decorators' => $this->buttonDecorators,
                ));
                $subform->setAction($this->getView()->url(array(
                    'controller' => 'admin',
                    'action'     => 'editfaq',
                    //'idfaq'      => $user['ID'],
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
                    //'idfaq'      => $user['ID'],
                    'subform'    => 'subform'.$i
                    ), 
                    'default',true
                ));
                $subform->setMethod('post');
            }
    
            $subform->populate($user);
            $this->addSubForm($subform,'subform'.$i);
            $subform->setDecorators(array(
                'FormElements',
                array('HtmlTag', array('tag' => 'dl',
                    'class' => 'zend_form')),
                array('Description', array('placement' => 'prepend', 'class' => 'formerror')),                                   
                'Form',
            ));
		} // end foreach
		
       $this->setDecorators(array(
           'FormElements',
           array('HtmlTag', array('tag' => 'table')),
           array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
           'Form'
       )); 
    }


}