<?php

class StaffController extends Zend_Controller_Action
{
    protected $_staffmodel;
    protected $_evacuationform;
    protected $_company;
    protected $_imm;
    protected $_floor;
    protected $_zone;
    protected $_fileform;
    	
    public function init()
    {
        $this->_authService = new Application_Service_Authentication();
        $this->_company = $this->_authService->getIdentity()->Societa_staff;
        $this->_staffmodel = new Application_Model_Staff;
        $this->_helper->layout->setLayout('arear');
        $this->_fileform = $this->getAssignPlanForm();
        $this->_evacuationform = $this->getEvacuationForm($this->_company);
        $this->_imm = ($this->_getParam('immobile')==null ? null: $this->_getParam('immobile'));
        $this->_floor = ($this->_getParam('floor')==null ? null: $this->_getParam('floor'));  
        $this->_zone = ($this->_getParam('zone')==null ? null: $this->_getParam('zone'));
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
        
        
        $imm=$this->_imm;
        $floor=$this->_floor;
        $zone=$this->_zone;
        $imms = array();

            $immo = $this->_staffmodel->getImms($this->_company);                    
            $values = $this->_staffmodel->getInfoImms($immo);
            
            foreach ($values as $key => $value) {
                $imms[]=$value;
                
            }
            
        
        $this->_fileform = $this->getAssignPlanForm();
        $this->view->fileform = $this->_fileform;
        $this->view->assign(array('imms'     =>  $imms,
                                  'floors'   =>  $floors,
                                  'selimm'   =>  $imm,
                                  'selfloor' =>  $floor,
                                  ));
        
    
    }
        
    public function insertalertAction(){
        $this->view->msg = 'insertAlert';
		
    }
	
	public function removealertAction(){
		$cod_al = $this->_getParam('cod_al')==null ? null: $this->_getParam('cod_al');
         if ($cod_al==null) {
            $alert = $this->_staffmodel->getAlert($this->_authService->getIdentity()->Societa_staff);
			$this->view->alert = $alert;
         }
         else{
         	$this->_staffmodel->deleteAlert($cod_al);
         	$alert = $this->_staffmodel->getAlert($this->_authService->getIdentity()->Societa_staff);
			$this->view->alert = $alert;
		 }
    }
          
    public function evacuationAction(){
        $this->view->msg = 'evacuation';
        //$this->view->evform = $this->getEvacuationForm();
         $imm=$this->_imm;
        $floor=$this->_floor;

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
    
    public function assignAction(){
        
        $zone = $this->_zone;
        $floor = $this->_floor;
        $imm = $this->_imm;
        
        $values = $this->_fileform->getValues();
        $data = $this->_staffmodel->getEscapePlanInfo($zone,$floor,$imm);
        $info = array('Zona'                        =>      $data['Zona'],
                      'Immobile'                    =>      $data['Immobile'],
                      'Id_piano'                    =>      $data['Id_piano'],
                      'Piano_di_fuga'               =>      $data['Piano_di_fuga'],
                      'Piano_di_fuga_alternativo'   =>      $values['Piano_di_fuga_alternativo'],
                      'Mappatura_zona'              =>      $data['Mappatura_zona']
                       );
        $this->_staffmodel->setAlternativePlan($info);
        $this->_helper->redirector('welcome','staff');
        
    }
    
    
    
    
    public function deletealternativeplanAction(){
        
        $zone = $this->_zone;
        $floor = $this->_floor;
        $imm = $this->_imm;
        
        $values = $this->_fileform->getValues();
        $data = $this->_staffmodel->getEscapePlanInfo($zone,$floor,$imm);
        $info = array('Zona'                        =>      $data['Zona'],
                      'Immobile'                    =>      $data['Immobile'],
                      'Id_piano'                    =>      $data['Id_piano'],
                      'Piano_di_fuga'               =>      $data['Piano_di_fuga'],
                      'Piano_di_fuga_alternativo'   =>      null,
                      'Mappatura_zona'              =>      $data['Mappatura_zona']
                       );
        $this->_staffmodel->setAlternativePlan($info);
        $this->_helper->redirector('welcome','staff');
        
    }
    
    private function getEvacuationForm(){
           
        $f = new Application_Form_Staff_Evacuation_Evacuation();
        return $f;
    }
    
    private function getAssignPlanForm(){
           
        
        $urlHelper = $this->_helper->getHelper('url');
       $form = new Application_Form_Staff_Escapeplan_Assignplan();
       $form->setAction($urlHelper->url(array(
                        'controller' => 'staff',
                        'action'     => 'assign',
                        'floor'      => $this->_floor,
                        'immobile'   => $this->_imm,
                        'zone'       => $this->_zone                      
                        ), 
                        'default',true
       ));
       return $form;
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