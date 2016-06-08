<?php

class AdminController extends Zend_Controller_Action
{
    protected $_adminModel;
    
    protected $_idfaq;
    protected $_faqform;
    protected $_subform;
	protected $_insertfaqform;
    
    protected $_edituser;
    protected $_usersform;
    
    protected $_building;    
    protected $_buildingsform;
    protected $_editbuildingparamform;
    protected $_editbuildingsform;
    protected $_floorform;
    protected $_editfloorform;
    protected $_zoneform;
       	
    public function init(){
        $this->_helper->layout->setLayout('arear');
        $this->_adminModel = new Application_Model_Admin();
        
        $this->_idfaq = $this->_getParam('idfaq');
        $this->_faqform = $this->getShowFaqForm($this->_idfaq);
        $this->_subform = $this->_getParam('subform');
        
        $this->_edituser = $this->_getParam('edituser');
        $this->_usersform = $this->getShowUsersForm($this->_edituser == false ? false : true);
		
		$this->_insertfaqform = $this->getInsertFaqForm();
        
        $this->_building = $this->_getParam('building') == null ? null : $this->_getParam('building');
        $this->_buildingsform = $this->getShowBuildingsForm();
        $this->_editbuildingparamform = $this->getEditBuildingParamForm($this->_getParam('imms') == null ? null : $this->_getParam('imms'));
        $this->_editbuildingsform = $this->getEditBuildingForm($this->_getParam('imms') == null ? null : $this->_getParam('imms'));
        $this->_floorform = $this->getFloorForm($this->_getParam('building') == null ? null : $this->_getParam('building'), 
                                                $this->_getParam('floors') == null ? null : $this->_getParam('floors'));
        $this->_editfloorform = $this->getEditFloorForm($this->_getParam('building') == null ? null : $this->_getParam('building'), 
                                                        $this->_getParam('floors') == null ? null : $this->_getParam('floors'));
        $this->_zoneform = $this->getEditZoneForm($this->_getParam('building') == null ? null : $this->_getParam('building'), 
                                                  $this->_getParam('floor') == null ? null : $this->_getParam('floor'),
                                                  $this->_getParam('zones') == null ? null : $this->_getParam('zones'));
    }
    
    public function indexAction(){
    }
    public function welcomeAction(){
    }
	public function removeFaqAction(){
	}
    
    public function faqAction(){
        $this->view->msg='Gestisci le faq';
    }
    
    public function beforeinsertfaqAction(){
        $this->view ->msg ='insertfaq'; 
        $this->view->insertfaq = $this->_insertfaqform;       
    }
    
    public function insertfaqAction(){
        if (!$this->getRequest()->isPost()) {
             $this->_helper->redirector('welcome','user');
        }    
        if (!$this->_insertfaqform->isValid($_POST)) {
          
            $this->_insertfaqform->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->_helper->redirector('beforeinsertfaq','admin');
        }
		$values = $this->_insertfaqform->getValues();
            
		$values['ID'] = '';
		$this->_adminModel->insertFaq($values);
		$this->_helper->redirector('showfaq','admin');

    }
    
     /* Action chiamata quando si preme su Modifica Faq o Elimina Faq */
     public function showfaqAction(){
        // Definisce le variabili per il viewer
        $id=$this->_getParam('idfaq');
        if($id==null)
		{
        	$values = $this->_adminModel->extractFaq();
        	$this->view->faqs=$values;

		}else{
        	$this->_adminModel->deleteFaq($id);
        	$values = $this->_adminModel->extractFaq();
        	$this->view->faqs=$values;
		}
     }
    
    /* Action chiamata quando si preme il bottone relativo alla form di Modifica Faq */
    public function editfaqAction(){
        if($this->_edit==true){
            if (!$this->getRequest()->isPost()) {
                $this->_helper->redirector('faq','admin');
            }    
                                              
            if (!$this->getCurrentSubForm()->isValid($_POST)) {
                $this->getCurrentSubForm()->setDescription('Attenzione: alcuni dati inseriti sono errati.');
                return $this->render('showfaq');
            }
            
            $values = $this->getCurrentSubForm()->getValues();
            
            $result = array('ID'        => $values[$this->_subform]['ID'],
                            'Question'  => $values[$this->_subform]['Question'],
                            'Answer'    => $values[$this->_subform]['Answer']
                             );
            $this->_adminModel->modifyfaq($result);
            $this->render('welcome'); 
        }    
    }
    
    /* Action chiamata quando si preme il bottone relativo alla form di Elimina Faq */
    public function deletefaqAction(){
        if($this->_edit==false){
            $id=$this->_getParam('idfaq');
            $this->_adminModel->deleteFaq($id);
            $this->_helper->redirector('faq','admin');
        }   
    }
    
    public function getuserAction(){
        $this->view->msg='user'; 
        $usr = $this->_adminModel->getAllUsers();
        $this->view->users = $usr;
    }
    
    public function insertuserAction(){     
    }
    
    public function showusersAction(){
        $this->view->assign(array('users' => $this->_usersform));      
    }
    
    /* Action chiamata quando si preme il bottone relativo alla form di Elimina Utenti */
    public function deleteuserAction(){
        if($this->_edituser==false){
            $user = $this->_getParam('usrid');
            $this->_adminModel->deleteUser($user);
            $this->_helper->redirector('getuser','admin');
        }   
    }
    
    // Visualizza gli immobili presenti nel db e permette di modificarli, eliminarli o inserirne altri.
    public function immAction(){
        $this->view->msg='imm'; 
        $this->view->buildings = $this->_buildingsform; 
    }
    
    /* Dopo aver selezionato un immobile, se si è premuto su 'elimina', cancella l'immobile
     * e reindirizza alla action precedente; se si è premuto su 'modifica' apre una vista
     * con i campi da modificare dell'immobile e un'altra form che permette di modificare,
     * eliminare o inserire un nuovo piano nell'immobile.
     */
    public function editbuildingsAction(){
        if (!$this->getRequest()->isPost()) {
             $this->_helper->redirector('imm');
        }  
            // Se si è premuto su 'elimina'
        if($this->_getParam('elimina')){
            $imm = $this->_getParam('imms');
            $this->_adminModel->deleteBuilding($imm);
            $this->_helper->redirector('imm','admin');
        }   // Se si è premuto su 'modifica'
        if($this->_getParam('modifica')){
            $this->view->imm = $this->_getParam('imms');
            $this->view->pbuild = $this->_editbuildingparamform;
            $this->view->ebuild = $this->_editbuildingsform;
        }
    }
    
    // Action chiamata quando si modificano i parametri di un immobile (Nome, via ecc...)
    public function updatebuildingAction(){
        if (!$this->getRequest()->isPost()) {
             $this->_helper->redirector('imm');
        }  
        $values = $this->_editbuildingparamform->getValues();
        $info = array('Id'        => $this->_building,
                      'Nome'      => $values['Nome'],
                      'Citta'     => $values['Citta'],
                      'Provincia' => $values['Provincia'],
                      'Via'       => $values['Via']);
        $this->_adminModel->updateBuilding($info);
        $this->_helper->redirector('imm');
    }
     /* Dopo aver selezionato un piano di un immobile, la action gestisce la cancellazione del piano
      * oppure se si è premuto su modifica porta ad una vista dove si può cambiare la mappa del piano e 
      * gestire le zone del piano
      */   
    public function editfloorAction(){
        if (!$this->getRequest()->isPost()) {
             $this->_helper->redirector('imm');
        }  
        if($this->_getParam('elimina')){
                // floors è il nome del radio button
            $fl = $this->_getParam('floors');
            $bu = $this->_getParam('building');
            $this->_adminModel->deleteFloor($fl, $bu);
            $this->_helper->redirector('imm','admin');
        }
        if($this->_getParam('modifica')){
            $this->view->imm = $this->_getParam('building');
            $this->view->fl = $this->_getParam('floors');
            $this->view->ff = $this->_floorform;
            $this->view->eff = $this->_editfloorform;
        }
    }
    
    // Action che si attiva quando si modifica la mappa di un piano.
    public function editmapAction(){
        $values = $this->_floorform->getValues();
        if($values){
            $data = $this->_adminModel->getFloorInfo($this->_getParam('building'), $this->_getParam('floor'));
            $info = array('Id_piano'    => $data['Id_piano'],
                          'Mappa'       => $values['map'] == null ? $data['Mappa'] : $values['map'],
                          'Immobile'    => $data['Immobile'],
                          'Societa'     => $data['Societa'],
                          'Evacuazione' => $data['Evacuazione']
                          );
            $this->_adminModel->updateFloor($info, $this->_getParam('building'), $this->_getParam('floor'));           
            $this->_helper->redirector('imm');
        }
    }

    // Mostra una form per modificare i campi di una zona, dopo aver cliccato su 'modifica' dalla modifica del piano.
    public function editzoneAction(){
        $this->view->i = $this->_getParam('building');
        $this->view->fl = $this->_getParam('floor');
        $this->view->z = $this->_getParam('zones');
        $this->view->f = $this->_zoneform;
    }
    
    private function getLoginForm(){
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
    
    private function getShowFaqForm($idfaq){
    	if($idfaq==null){}
		else
		{
			$faq= $this->_adminModel->extractfaqbyid($idfaq);
        	$this->_faqform = new Application_Form_Admin_Faq_Showfaq();
        	$this->_faqform->createForm($faq);
        	return $this->_faqform;
		}
    }
  
    public function getCurrentSubForm(){        
        foreach (array_keys($this->_faqform->getSubForms()) as $name) {
            if ($data = $this->getRequest()->getPost($name, false)) {
                if (is_array($data)) {
                    return $this->_faqform->getSubForm($name);
                    break;
                }
            }
        }
        return false;
    } 
    
    public function getShowUsersForm($edit){
        $this->_f = new Application_Form_Admin_Users_Showusers();
        $this->_f->createForm($edit);
        return $this->_f;
    }
	
	private function getInsertFaqForm(){
	   $form = new Application_Form_Admin_Faq_Insertfaq();
	   return $form;
	}  
    
    private function getShowBuildingsForm(){
        $urlHelper = $this->_helper->getHelper('url');
        $f = new Application_Form_Admin_Buildings_Showbuildings();
        $f->createForm();
        $f->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action'     => 'editbuildings'
            ), 
            'default',true
        ));
        return $f;
    } 
    
    private function getEditBuildingParamForm($imm){
        $urlHelper = $this->_helper->getHelper('url');
        $f = new Application_Form_Admin_Buildings_Buildingparam();
        $f->createForm($imm);
        $f->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action'     => 'updatebuilding',
            'building'   => $imm
            ), 
            'default',true
        ));
        return $f;
    }
    
    private function getEditBuildingForm($imm){
        $urlHelper = $this->_helper->getHelper('url');
        $f = new Application_Form_Admin_Buildings_Editbuilding();
        $f->createForm($imm);
        $f->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action'     => 'editfloor',
            'building'   => $imm
            ), 
            'default',true
        ));
        return $f;
    }
    
    private function getFloorForm($building, $floor){
        $urlHelper = $this->_helper->getHelper('url');
        $f = new Application_Form_Admin_Buildings_Editfloormap();
        $f->createForm($building, $floor);
        $f->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action'     => 'editmap',
            'building'   => $building,
            'floor'      => $floor,
            ), 
            'default',true
        ));
        return $f;
    }
    
    private function getEditFloorForm($building, $floor){
        $urlHelper = $this->_helper->getHelper('url');
        $f = new Application_Form_Admin_Buildings_Editfloor();
        $f->createForm($building, $floor);
        $f->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action'     => 'editzone',
            'building'   => $building,
            'floor'      => $floor,
            ), 
            'default',true
        ));
        return $f;
    }
    
    private function getEditZoneForm($bu, $fl, $z){
        $urlHelper = $this->_helper->getHelper('url');
        $f = new Application_Form_Admin_Buildings_Editzone();
        $f->createForm($bu, $fl, $z);
        $f->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action'     => 'hh',
            'building'   => $bu,
            'floor'      => $fl,
            ), 
            'default',true
        ));
        return $f;
    }
 }