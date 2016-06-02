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
	
    public function init()
    {
		$this->_helper->layout->setLayout('main');
        $this->_loginform = $this->getLoginForm();
        /* istanzia la classe per l'autenticazione degli utenti */
        $this->_authentication = new Application_Service_Authentication();
        $this->_publicModel = new Application_Model_Public();
        $this->_newuserform = $this->getNewUserForm();
        
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
            return $this->_helper->redirector('authenticate');
        }
        $form = $this->_loginform;
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
                return $this->_helper->redirector('changeposition', 'user'); 
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
         $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('index');
        }
        $form = $this->_newuserform;
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

