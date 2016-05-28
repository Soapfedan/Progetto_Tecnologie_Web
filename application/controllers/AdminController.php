<?php

class AdminController extends Zend_Controller_Action
{	
    public function init()
    {
        $this->_helper->layout->setLayout('arear');
       
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
    }
    
    public function immAction(){
        $this->view->msg='imm';  
    }   
 }