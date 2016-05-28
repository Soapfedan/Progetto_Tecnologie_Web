<?php

class UserController extends Zend_Controller_Action
{
	protected $_userModel;
	protected $_auth;
    
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
    }
     
      public function viewescapeplanAction(){
          
        $this->view->msg = 'viewEscapePlan';
    } 
   
}