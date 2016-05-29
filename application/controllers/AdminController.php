<?php

class AdminController extends Zend_Controller_Action
{
    	
    public function init()
    {
        $this->_helper->layout->setLayout('arear');
        $this->_adminModel = new Application_Model_Admin();
        //$this->_test = $this->_getParam('test');
        //$this->_form = $this->getProfileForm(($this->_test==false ? false : true));
    }
    public function indexAction()
    {
    }
    
     public function welcomeAction(){
     
    }
	
	public function removeFaqAction(){
		
	}
    
    public function faqAction(){
      $this->view->msg='faq'; 
        
        $faqform=$this->getShowFaqForm();
        
        // Definisce le variabili per il viewer
        $this->view->assign(array('faqs' => $faqform)); 
    }
    
    public function getuserAction(){
        $this->view->msg='user'; 
        
        //  Estrae tutti gli utenti registrati al sito.               
        $datauser = $this->_adminModel->getAllUsers();
                 
        // Definisce le variabili per il viewer
        $this->view->assign(array('users' => $datauser)); 
    }
    
    public function immAction(){
        $this->view->msg='imm';  
    }
    
    private function getLoginForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $loginform = new Application_Form_Public_Auth_Login();
        $loginform->setAction($urlHelper->url(array(
                        'controller' => 'public',
                        'action'     => 'authenticate'
                        ), 
                        'default',true
                    ));
        return $loginform;
    }
    
    private function getShowFaqForm()
    {
        $faqform = new Application_Form_Admin_Faq_Showfaq();
        return $faqform;
    }
       
 }