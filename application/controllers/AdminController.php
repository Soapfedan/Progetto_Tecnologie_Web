<?php

class AdminController extends Zend_Controller_Action
{	
    public function init()
    {
        $this->_helper->layout->setLayout('arear');
        $this->_adminModel = new Application_Model_Admin();
       
    }
    public function indexAction()
    {
    }
    
     public function welcomeAction(){
     
    }
    
    public function faqAction(){
      $this->view->msg='faq';  
    }
    
    public function userAction(){
        $this->view->msg='user'; 
        
        //  Estrae tutti gli utenti registrati al sito.               
        $datauser = $this->_adminModel->getAllUsers();
                 
        // Definisce le variabili per il viewer
        $this->view->assign(array('users' => $datauser)); 
    }
    
    public function immAction(){
        $this->view->msg='imm';  
    }   
 }