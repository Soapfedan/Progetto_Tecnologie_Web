<?php

class StaffController extends Zend_Controller_Action
{
    protected $_staffmodel;
    protected $_evacuationform;
    protected $_company;
    	
    public function init()
    {
        $this->_authService = new Application_Service_Authentication();
        $this->_company = $this->_authService->getIdentity()->Societa_staff;
        $this->_staffmodel = new Application_Model_Staff;
        $this->_helper->layout->setLayout('arear');
        $this->evacuationform = $this->getEvacuationForm($this->_company);
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
    
    private function getEvacuationForm($company){
        $f = Application_Form_Staff_Evacuation();
        $f->create_form($company);
    }
 }