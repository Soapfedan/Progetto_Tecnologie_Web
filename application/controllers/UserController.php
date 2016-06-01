<?php

class UserController extends Zend_Controller_Action
{
	protected $_userModel;
	protected $_auth;
    protected $_username;
    protected $_completed;
    protected $_filled;
    protected $_editform;
    protected $_insertprofileform;
    
    
    
    
    public function init()
    {
        
		$this->_userModel = new Application_Model_User();
        $this->_helper->layout->setLayout('arear');
        $this->_authService = new Application_Service_Authentication();
        $this->_completed = $this->_getParam('completed');
        $this->_filled = $this->_getParam('filled');
        $this->_username = $this->_getParam('username');
        $this->_editform = $this->getProfileForm(($this->_completed==false ? false : true),
                                                         ($this->_filled==false ? false : true),
                                                         ($this->_username==null ? null : $this->_username),
                                                          'editprofile');
        $this->_insertprofileform = $this->getInsertUserForm($this->_username);                                                         
        
        
    }

    public function indexAction(){
        
    }
    
    public function welcomeAction(){
        
    }
 	
    public function logoutAction(){
        
        $this->_authService->clear();
        return $this->_helper->redirector('index','public');    
    }
    
   
    public function sendalertAction(){
        
        $this->view->msg = 'sendalert';
    }
    
    public function changepositionAction(){
        
        $this->view->msg = 'changeposition';
        
        //$identity = $this->_authService->getIdentity();
        $this->view->$imms = $this->_userModel->getallImms;
        // $floors = $this->_userModel->getFloors($imm);
        return $this->_helper->redirector('welcome','user'); 
        
    }
    
    public function editprofileAction(){
        
        $this->view->msg = 'editProfile';
        $this->view->profileForm= $this->_editform;
    }
     
    public function viewescapeplanAction(){
          
        $this->view->msg = 'viewEscapePlan';
    } 
      
    public function updateprofileAction(){
        
        $identity = $this->_authService->getIdentity();
        
          
        if (!$this->getRequest()->isPost()) {
            
            $this->_helper->redirector('welcome','user');
        }    
                                              
        if (!$this->_editform->isValid($_POST)) {
          
            $this->_editform->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('editprofile');
        }
        
        $values = $this->_editform->getValues();
        $values['Username']=$this->_authService->getIdentity()->Username;
        $values['Password']=$this->_authService->getIdentity()->Password;
        $values['Categoria']=$this->_authService->getIdentity()->Categoria;
        $values['Societa_staff']=$this->_authService->getIdentity()->Societa_staff;
        $this->_userModel->updateUserInformation($values);
        $this->_helper->redirector('welcome','user'); 
        
          
   }
      
   public function insertuserAction(){
       
        $this->view->insertForm = $this->_insertprofileform;
           
   }
      
   public function newuserAction(){
       
       $identity = $this->_authService->getIdentity();
        
       if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('welcome','user');
       }    
                                              
       if (!$this->_insertprofileform->isValid($_POST)) {
          
            $this->_insertprofileform->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('insertuser');
       }
       
       $values = $this->_insertprofileform->getValues();
       $this->_userModel->insertNewUser($values);
       $this->_helper->redirector('welcome','user'); 
        
           
   }
      
      
   private function getProfileForm($completed,$filled,$username,$action){
      
            
       $urlHelper = $this->_helper->getHelper('url');
       $form = new Application_Form_User_Profilo_Profile();
       $form->createForm($completed,$filled,$username);
       $form->setAction($urlHelper->url(array(
                        'controller' => 'user',
                        'action'     => $action
                        ), 
                        'default',true
       ));
                    
       return $form;
   }
    
   
   private function getInsertUserForm($username){
       
      $this->_insertprofileform = $this->getProfileForm(true, false, $username,'newuser');
       
      return $this->_insertprofileform;
   }
   
   public function changepasswordformAction(){
   
      $this->view->pswf = $this->_pswform;
   }
    
   public function changepasswordAction(){
    
      $values = $this->_pswform->getValues;
      $usr =$this->_authService->getIdentity()->Username;
      $var = array('Username' => $usr, 'Password' => $values['Newpassword']);
      $this->_userModel->updatePassword($var);
   }
        
   private function getProfileForm($completed,$filled,$username,$action){
   
      $urlHelper = $this->_helper->getHelper('url');
   }
      
   private function getPswForm($pass){
   
      $p->createForm($pass);
      $p->setAction($urlHelper->url(array(
                                         'controller' => 'user',
                                         'action'     => 'changepassword'
                                         ), 
                                         'default',true    
      ));
   }
}