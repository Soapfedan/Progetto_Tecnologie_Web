<?php

class StaffController extends Zend_Controller_Action
{	
    public function init()
    {
        $this->_helper->layout->setLayout('arear');
        $this->view->menu = '_adminmenu.phtml';
    }
    public function indexAction()
    {
    }
    
     public function welcomeAction(){
        
    }
    public function panelAction(){
        
        $this->view->msg = 'panel';
    }
      
    public function assignescapeplanAction(){
        $this->view->msg = 'assignEscapePlan';
    }
        
    public function managealertAction(){
        $this->view->msg = 'manageAlert';
    }
          
    public function evacuationAction(){
        $this->view->msg = 'evacuation';
    } 
 }