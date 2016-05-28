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
        $completed = $this->_getParam('staticPage');
        $filled = $this->_getParam('staticPage');
        $username = $this->_getParam('staticPage');
        $this->view->profileForm = $this->getProfileForm(($completed==false ? false : true),
                                                         ($filled==false ? false : true),
                                                         ($username==null ? null : $username)); 
        
        
    }
     
      public function viewescapeplanAction(){
          
        $this->view->msg = 'viewEscapePlan';
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
        $this->_form->setAction($urlHelper->url(array(
                        'controller' => $controller,
                        'action'     => 'index'
                        ), 
                        'default',true
                    ));
        return $this->_form;
    }
    }
   
}