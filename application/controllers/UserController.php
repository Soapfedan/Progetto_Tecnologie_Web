<?php

class UserController extends Zend_Controller_Action
{
	protected $_userModel;
	protected $_auth;
    protected $_username;
    protected $_completed;
    protected $_filled;
    protected $_form;
    
    public function init()
    {
        
		$this->_userModel = new Application_Model_User();  
         $this->_helper->layout->setLayout('arear');
         $this->_authService = new Application_Service_Authentication();
       
    }

    public function indexAction()
    {
        
    }
    public function welcomeAction(){
        
    }
 	
    public function logoutAction()
    {
        $this->_authService->clear();
        return $this->_helper->redirector('index','public');    
    }
    
   
      public function sendalertAction(){
        
        $this->view->msg = 'sendalert';
    }
    
    public function changepositionAction(){
        
        $this->view->msg = 'changeposition';
    }
    
     public function editprofileAction(){
        
        $this->view->msg = 'editProfile';
        $this->_completed = $this->_getParam('completed');
        $this->_filled = $this->_getParam('filled');
        $this->_username = $this->_getParam('username');
        $this->view->profileForm = $this->getProfileForm(($this->_completed==false ? false : true),
                                                         ($this->_filled==false ? false : true),
                                                         ($this->_username==null ? null : $this->_username)); 
        
        
    }
     
      public function viewescapeplanAction(){
          
        $this->view->msg = 'viewEscapePlan';
    } 
      
      public function updateprofileAction(){
          
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form=$this->_form;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('editprofile/completed'.$this->_completed.'/filled/'.$this->_filled.'/username/'.$this->_username);
        }
        $values = $form->getValues();
        $this->_userModel->insertNewUser($values);
        $identity = $this->_authService->getIdentity();
        if($identity!=false){
            $controller='user';
         switch ($identity->Categoria) {
            case 1:
               $controller='user'; 
                break;
             case 2:
                $controller='staff';
                break;
                  case 3:
                $controller='admin';
                break;
            default:
                
                break;
        }
        $this->_helper->redirector($controller.'/welcome'); 
        }
          
      }
      
       private function getProfileForm($completed,$filled,$username)
    {
        $identity = $this->_authService->getIdentity();
        if($identity!=false){
            $controller='user';
         switch ($identity->Categoria) {
            case 1:
               $controller='user'; 
                break;
             case 2:
                $controller='staff';
                break;
                  case 3:
                $controller='admin';
                break;
            default:
                
                break;
        }
            
        $urlHelper = $this->_helper->getHelper('url');
        $this->_form = new Application_Form_User_Profilo_Profile();
        $this->_form->createForm($completed,$filled,$username);
        $this->_form->setAction($urlHelper->url(array(
                        'controller' => 'user',
                        'action'     => 'updateprofile'
                        ), 
                        'default',true
                    ));
        return $this->_form;
    }
    }
   
}