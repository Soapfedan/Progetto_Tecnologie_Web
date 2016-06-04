<?php

class UserController extends Zend_Controller_Action
{
	protected $_userModel;
	protected $_authService;
    protected $_username;
    protected $_completed;
    protected $_filled;
    protected $_editform;
    protected $_insertprofileform;
	
    protected $_sendalertform;
    protected $_imm;
    protected $_floor;

    
    
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
                                                          'updateprofile');
        $this->_insertprofileform = $this->getInsertUserForm($this->_username);
		$this->_sendalertform = $this->getSendAlertForm();
        $this->_imm = ($this->_getParam('immobile')==null ? null: $this->_getParam('immobile'));
        $this->_floor = ($this->_getParam('floor')==null ? null: $this->_getParam('floor'));                                                   
    }

    public function indexAction(){
    }
    
    public function welcomeAction(){
        $this->view->evac='';
        if($this->_authService->getIdentity()->Categoria==1){
            $pos=$this->_userModel->getPosition($this->_authService->getIdentity()->Username);
            if($pos!=null){
                $evacstate=$this->_userModel->checkEvacuationState($pos['Id_piano'],$pos['Immobile']);
                if($evacstate['Evacuazione']==1){
                    $this->view->evac='Attenzione devi evacuare il tuo piano !!!!';
                }  
            }    
        }
    }
 	
    public function logoutAction(){
        if($this->_authService->getIdentity()->Categoria==1){
            $this->deleteUserPosition();
        }
        $this->_authService->clear();
        return $this->_helper->redirector('index','public');    
    }
    
   
    public function sendalertAction(){
        $this->view->msg = $this->_sendalertform;
        $pos = $this->_userModel->getPosition($this->_authService->getIdentity()->Username);
        if($pos==null){
            $this->_helper->redirector('changeposition','user');
        }
    }
    
    public function insertalertAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('welcome','user');
        }   
        if (!$this->_sendalertform->isValid($_POST)) {
            $this->_editform->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('sendalert');
        }
        $values = $this->_sendalertform->getValues();
        $floor = $this->_getParam('floor');
        $immo = $this->_getParam('immobile');
        
        $this->_userModel->insertAlert(array('Data_Segnalazione' => date("Y-m-d"),
                                                'Ora_Segnalazione'  => date("h:i:s"),
                                                'Id_Piano'          => $floor,
                                                'Codice_Zona'       => $values['Codice_Zona'],
                                                'Utente'            => $this->_authService->getIdentity()->Username,
                                                'Tipo_Catastrofe'   => $values['Tipo_Catastrofe'],
                                                'Immobile'          => $immo

                                         ));
                                               
        return $this->_helper->redirector('welcome','user'); 
    }
    
    
    public function changepositionAction(){
        
        $usr = $this->_authService->getIdentity()->Username;
        $nome = $this->_authService->getIdentity()->Nome;
        $cognome = $this->_authService->getIdentity()->Cognome;
        $pos = $this->_userModel->getPosition($usr);
        if($pos!=null){
            $this->view->welcomemsg = 'Ciao ' . $nome . ' '. $cognome . ' la tua posizione attuale: '.
              '<div id="position"'.
              '<br />'.' Immobile: '.$pos['Immobile'].','.
              '<br />'.' Piano: '   .$pos['Id_piano'].','.
              '<br />'.' Zona: '    .$pos['Zona'].
              '<br />'.'</div>'; 
        }else{
            $this->view->welcomemsg = 'Ehi '. $nome . ' '. $cognome. ' inserisci, per favore, la tua posizione';
        }
            
        $imm=$this->_imm;
        $floor=$this->_floor;
        
        $imms = array();
        $floors = array();
        $map = null;
        $schema = null;
        if($imm==null){
            
            $values=$this->_userModel->getallImms();
            
            foreach ($values as $key => $value) {
                $imms[]=$value['Immobile'];
                
            }
            
        }else{
            if($floor==null){
                
                $values1 = $this->_userModel->getFloors($imm);
                
                foreach ($values1 as $key => $valfloor) {
                  $floors[]=$valfloor['Id_piano'];
                
                }  
            }else{
                
                $map = $this->_userModel->getMap($floor,$imm);
                $schema = $this->_userModel->getMapMapped($floor,$imm);
            }
            
        }
        $this->view->assign(array('msg'      =>  'changeposition',
                                  'imms'     =>  $imms,
                                  'floors'   =>  $floors,
                                  'selimm'   =>  $imm,
                                  'selfloor' =>  $floor,
                                  'map'      =>  $map,
                                  'schema'   =>  $schema));
        
    }
   
    
    public function editprofileAction(){
        $this->view->msg = 'editProfile';
        $this->view->profileForm= $this->_editform;
    }
     
    public function viewescapeplanAction(){
        $this->view->msg = 'viewEscapePlan';
        $pos = $this->_userModel->getPosition($this->_authService->getIdentity()->Username);
        if($pos==null){
            $this->_helper->redirector('changeposition','user');
        }else{
            var_dump($pos);
            $this->view->assign(array('pos'=>$pos['Immobile']));
            $this->view->escapeplan = $this->_userModel->getEscapePlan($pos['Zona'],$pos['Id_piano'],$pos['Immobile']);
        }
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
        $values['Categoria']=$this->_authService->getIdentity()->Categoria;
        $values['Societa_staff']=$this->_authService->getIdentity()->Societa_staff;
            // Elimina chiavi dalla form che non corrispondono agli attributi della tabella
        unset($values['Password1']);
        unset($values['Password2']);  
            // Aggiorna le informazioni dell'utente 
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
   
   public function setpositionAction(){
       $zone=($this->_getParam('zone')==null ? null: $this->_getParam('zone'));
       $data = array('Utente'   => $this->_authService->getIdentity()->Username,
                     'Id_piano'   => $this->_floor,
                     'Immobile'   => $this->_imm,
                     'Zona'       => $zone
                     );
       if($this->_userModel->getPosition($data['Utente'])==null){
           //utente senza posizione
           $this->_userModel->insertPosition($data);
           
       }else{
           $this->_userModel->updatePosition($data);
       }
       $this->_helper->redirector('welcome','user');        
   }
   
   public function deletepositionAction(){
       $this->deleteUserPosition();
       $this->_helper->redirector('welcome','user');
   }
   
   
   private function deleteUserPosition(){
       if($this->_userModel->getPosition($this->_authService->getIdentity()->Username)!=null){
            $this->_userModel->deletePosition($this->_authService->getIdentity()->Username);
       }
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
   
   //estrae tutte le zone in base alla posizione dell'utente
   private function getZoneByPosition(){
   	
   		$position = $this->_userModel->getPosition($this->_authService->getIdentity()->Username);
		return $position;
   	
   }
   
   private function getSendAlertForm(){
        
   		$form = new Application_Form_User_Segnalazioni_Segnalazione();
		$pos = $this->getZoneByPosition();
        if($pos!=null){
        $valuesZone =$this->_userModel->getAllZone($pos['Immobile'],$pos['Id_piano']);
        $valuesDisaster = $this->_userModel->extractDisaster();
		$form->create($pos['Immobile'],$pos['Id_piano'],$valuesZone,$valuesDisaster);
		return $form;
        }
   }
}