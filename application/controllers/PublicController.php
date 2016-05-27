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
	
    public function init()
    {
		$this->_helper->layout->setLayout('main');
        $this->view->loginForm = $this->getLoginForm();
        /* istanzia la classe per l'autenticazione degli utenti */
        $this->_authentication = new Application_Service_Authentication();
        $this->_publicModel = new Application_Model_Public();
        
    }

 
    public function indexAction()
    {$db = $this->getInvokeArg('bootstrap')->getResource('db');
        if($db->isConnected()){
           /*  //  Estrae le faq               
        $datafaq=$this->_publicModel->extractFaq();
                 
        // Definisce le variabili per il viewer
        $this->view->assign(array('faqs' => $datafaq));*/
        $this->render('who');
        } else {
            $this->render('where');
        }          
       
   
    }
    public function faqAction(){
        //  Estrae le faq               
        $datafaq=$this->_publicModel->extractFaq();
                 
        // Definisce le variabili per il viewer
        $this->view->assign(array('faqs' => $datafaq));
    }
    
    public function viewstaticAction () {
    	$page = $this->_getParam('staticPage');
        $this->render($page);
    }
    
    private function getLoginForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_form = new Application_Form_Public_Auth_Login();
        $this->_form->setAction($urlHelper->url(array(
                        'controller' => 'public',
                        'action'     => 'authenticate'
                        ), 
                        'default',true
                    ));
        return $this->_form;
    }

    public function loginAction(){
        $this->_helper->layout->setLayout('login');       
    }
    
    public function authenticateAction()
    {
        /* Setto anche il layout del login oltre al reindirizzamento */
        $this->_helper->layout->setLayout('login');
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('authenticate');
        }
        $form = $this->getLoginForm();
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('login');
        }
        if (false === $this->_authentication->authenticate($form->getValues())) {
            $form->setDescription('Autenticazione fallita. Riprova');
            return $this->render('login');
        }
        return $this->_helper->redirector('index', $this->_authentication->getIdentity()->role);
    }
}

