<?php

class PublicController extends Zend_Controller_Action
{
    /*
     * L'oggetto di tipo Application_Model_Admin è istanziato
     * nella classe Authentication. Qui si può cancellare quindi
     * $_publicModel
     */
	protected $_publicModel;
    protected $_authentication;
    protected $_loginform;
    protected $_newuserform;
    protected $_imm;
    protected $_floor;
	
    public function init()
    {
		$this->_helper->layout->setLayout('main');
        $this->_loginform = $this->getLoginForm();
        /* istanzia la classe per l'autenticazione degli utenti */
        $this->_authentication = new Application_Service_Authentication();
        $this->_publicModel = new Application_Model_Public();
        $this->_newuserform = $this->getNewUserForm();
        $this->_imm = ($this->_getParam('immobile')==null ? null: $this->_getParam('immobile'));
        $this->_floor = ($this->_getParam('floor')==null ? null: $this->_getParam('floor'));    
        
    }

 
    public function indexAction()
    {
    }         
       
   public function whoAction()
    {
    } 
    
    public function whereAction()
    {
    } 
    public function faqAction(){
        //  Estrae le faq               
        $datafaq=$this->_publicModel->extractFaq();
                 
        // Definisce le variabili per il viewer
        $this->view->assign(array('faqs' => $datafaq));
    }
     
      public function verifyauthAction()
    {
        
    } 
    
    // Validazione AJAX
    public function validateloginAction() 
    {
        $this->_helper->getHelper('layout')->disableLayout();
            $this->_helper->viewRenderer->setNoRender();

        $loginform = new Application_Form_Public_Auth_Login();
        $response = $loginform->processAjax($_POST); 
        if ($response !== null) {
            $this->getResponse()->setHeader('Content-type','application/json')->setBody($response);         
        }
    } 
     
    private function getLoginForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $form = new Application_Form_Public_Auth_Login();
        $form->setAction($urlHelper->url(array(
                        'controller' => 'public',
                        'action'     => 'authenticate'
                        ), 
                        'default',true
                    ));
        return $form;
    }

    public function loginAction(){
        $this->_helper->layout->setLayout('login');
        $this->view->loginForm = $this->_loginform;       
    }
    
    public function authenticateAction()
    {
        /* Setto anche il layout del login oltre al reindirizzamento */
        $this->_helper->layout->setLayout('login');
        
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('index');
        }
        $form = $this->_loginform;
        $this->view->loginForm = $form; 
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('login');
        }
        if (false === $this->_authentication->authenticate($form->getValues())) {
            $form->setDescription('Autenticazione fallita. Riprova');
            return $this->render('login');
        }
        $controller='user';
        switch ($this->_authentication->getIdentity()->Categoria) {
            case 1:
               $controller='user';
                return $this->_helper->redirector('setinitialposition'); 
                break;
             case 2:
                $controller='staff';
                break;
                  case 3:
                $controller='admin';
                break;
            default:
                
                break;
        }
        return $this->_helper->redirector('welcome', $controller);
    }

    public function signupAction()
    {
        $this->_helper->layout->setLayout('login');
        $this->view->signupForm = $this->_newuserform;    
    }
    
    public function insertnewuserAction()
    {
        $this->_helper->layout->setLayout('login');
         $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('index');
        }
        $form = $this->_newuserform;
        $this->view->signupForm = $form;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('signup');
        }
            $values=$form->getValues();
           
        $results = array('Username'         => $values['Username'],
                         'Password'         => $values['Password'],
                         'Nome'             => $values['Nome'],
                         'Cognome'          => $values['Cognome'],
                         'Data_di_Nascita'  => $values['Data_di_Nascita'],
                         'Citta'            => $values['Citta'],
                         'Provincia'        => $values['Provincia'],
                         'Genere'           => $values['Genere'], 
                         'Codice_fiscale'   => $values['Codice_fiscale'],
                         'Email'            => $values['Email'],
                         'Telefono'         => $values['Telefono'],
                         'Categoria'        => 1,   
                         'Societa_staff'    => $values['Societa_staff'],
             );
            
            $this->_publicModel->insertNewUser($results);
         return $this->_helper->redirector('index', 'public');
    }
    
    public function setinitialpositionAction(){
        $this->_helper->layout->setLayout('login');   
        $imm=$this->_imm;
        $floor=$this->_floor;
        $map=null;
        $schema=null;
        $imms = array();
        $floors = array();

        if($imm==null){
            
            $values=$this->_publicModel->getallImms();
            
            foreach ($values as $key => $value) {
                $imms[]=$value['Immobile'];
                
            }
            
        }else{
            if($floor==null){
                
                $values1 = $this->_publicModel->getFloors($imm);
                
                foreach ($values1 as $key => $valfloor) {
                  $floors[]=$valfloor['Id_piano'];
                
                }  
            }else{
                
                $map = $this->_publicModel->getMap($floor,$imm);
                $schema = $this->_publicModel->getMapMapped($floor,$imm);
            }
            
        }
        $this->view->assign(array('imms'     =>  $imms,
                                  'floors'   =>  $floors,
                                  'selimm'   =>  $imm,
                                  'selfloor' =>  $floor,
                                  'map'      =>  $map,
                                  'schema'   =>  $schema));
        
    
    }
    
    public function setpositionAction(){
       $zone=($this->_getParam('zone')==null ? null: $this->_getParam('zone'));
       $data = array('Utente'   => $this->_authentication->getIdentity()->Username,
                     'Id_piano'   => $this->_floor,
                     'Immobile'   => $this->_imm,
                     'Zona'       => $zone
                     );
       
        if($this->_publicModel->getPosition($data['Utente'])==null){
           //utente senza posizione
           $this->_publicModel->insertPosition($data);
           
       }else{
           $this->_publicModel->updatePosition($data);
       }

       $this->_helper->redirector('welcome','user');        
   }
    
    private function getNewUserForm()
    {
         $urlHelper = $this->_helper->getHelper('url');
        $form = new Application_Form_Public_Signup_Newuser();
        $form->setAction($urlHelper->url(array(
                        'controller' => 'public',
                        'action'     => 'insertnewuser'
                        ), 
                        'default',true
                    ));
                    
        return $form;
    }
}

