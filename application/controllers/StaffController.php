<?php

class StaffController extends Zend_Controller_Action
{
    protected $_staffmodel;
    protected $_evacuationform;
    protected $_company;
    protected $_imm;
    protected $_floor;
    	
    public function init()
    {
        $this->_authService = new Application_Service_Authentication();
        $this->_company = $this->_authService->getIdentity()->Societa_staff;
        $this->_staffmodel = new Application_Model_Staff;
        $this->_helper->layout->setLayout('arear');
        $this->_evacuationform = $this->getEvacuationForm($this->_company);
        $this->_imm = ($this->_getParam('immobile')==null ? null: $this->_getParam('immobile'));
        $this->_floor = ($this->_getParam('floor')==null ? null: $this->_getParam('floor'));  
  
    }
    public function indexAction()
    {
    }
    
     public function welcomeAction(){
     }
     
    public function panelAction(){
        
        $this->view->msg = 'panel';
        $this->_staffmodel->getImms($this->_company);
        
        
    }
      
    public function assignescapeplanAction(){
        $this->view->msg = 'assignEscapePlan';
    }
        
    public function insertalertAction(){
        $this->view->msg = 'insertAlert';
		
    }
	
	public function removealertAction(){
        $this->view->msg = 'removeAlert';
		$alert = $this->_staffmodel->getAlert($this->_authService->getIdentity()->Societa_staff);
		$this->view->alert = $alert;
    }
          
    public function evacuationAction(){
        $this->view->msg = 'evacuation';
        //$this->view->evform = $this->getEvacuationForm();
         $imm=$this->_imm;
        $floor=$this->_floor;
        $map=null;
        $schema=null;
        $imms = array();
        $floors = array();

        if($imm==null){
            
            $values=$this->_staffmodel->getImms($this->_company);
            
            foreach ($values as $key => $value) {
                $imms[]=$value['Immobile'];
                
            }
            
        }else{
            if($floor==null){
                
                $values1 = $this->_staffmodel->getFloors($imm);
                
                foreach ($values1 as $key => $valfloor) {
                  $floors[]=$valfloor['Id_piano'];
                
                }  
            }else{
                
                
            }
            
        }
        $this->view->assign(array('imms'     =>  $imms,
                                  'floors'   =>  $floors,
                                  'selimm'   =>  $imm,
                                  'selfloor' =>  $floor,
                                  ));
        
    
    } 
    
    public function setevacuationAction(){
       $evac = ($this->_getParam('evac')==null ? null: $this->_getParam('evac'));
       $this->_staffmodel->setEvacuationState($this->_floor,$this->_imm,$evac);

       $this->_helper->redirector('welcome','staff');        
   
    }
    
    private function getEvacuationForm(){
           
        $f = new Application_Form_Staff_Evacuation_Evacuation();
        return $f;
    }
    
    
    
    
    
    public function getdataAction()
    {
        $this->_helper->getHelper('layout')->disableLayout();
            $this->_helper->viewRenderer->setNoRender();

        if ($this->getRequest()->isXmlHttpRequest()) {
            $imms = $this->_staffmodel->getImms('1');
            $dojoData= new Zend_Dojo_Data('Immobile',$imms->toArray(),'Immobile');
            $this->view->dojo= $dojoData->toJson();
        }
        
        
    }
 }