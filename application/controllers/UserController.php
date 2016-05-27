<?php

class UserController extends Zend_Controller_Action
{
	protected $_catalogModel;
	
    public function init()
    {
		//$this->_catalogModel = new Application_Model_Admin();  
         $this->_helper->layout->setLayout('arear');
       //$this->view->menu = '_usermenu.phtml';
    }

    public function indexAction()
    {
        
    }
    public function welcomeAction(){
        
    }
 	
    public function viewstaticAction () {
    	$page = $this->_getParam('staticPage');
    	$this->render($page);
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