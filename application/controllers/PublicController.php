<?php

class PublicController extends Zend_Controller_Action
{
	protected $_catalogModel;
    protected $_authentication;
	
    public function init()
    {
		$this->_helper->layout->setLayout('main');
        $this->view->loginForm = $this->getLoginForm();
        /* istanzia la classe per l'autenticazione degli utenti */
        $this->_authentication = new Application_Service_Authentication();
        //$this->_catalogModel = new Application_Model_Admin();
    }

    public function indexAction()
    {    /*	    	
    	//  Estrae le Categorie Top    	    	
    	$topCats=$this->_catalogModel->getTopCats();

    	//  Estrae le Sottocategorie    	    	
		$topId = $this->_getParam('selTopCat', null);
		if (!is_null($topId)) {
    		$subCats=$this->_catalogModel->getCatsByParId($topId);
		} else {
			$subCats = null;
		}

		// Estrae i Prodotti
		$cat = $this->_getParam('selCat', null);
		$paged = $this->_getParam('page', 1);
		if (!is_null($cat)) {
			
		//	Categoria selezionata: estrae i prodotti
			$prods=$this->_catalogModel->getProdsByCat($cat, $paged, $order=null, $deep=false);
		} elseif (!is_null($topId)){
			
		//	TopCat selezionata: Estrae i prodotti in sconto
			$prods=$this->_catalogModel->getDiscProds($topId, $paged, $order=array('discountPerc DESC'), $deep=true); 
		} else {
			
		//	Nessuna selezione: estrae tutti i prodotti in sconto
			foreach ($topCats as $topCat) {
				$topCatsList[] = $topCat->catId;
			}
			$prods=$this->_catalogModel->getDiscProds($topCatsList, $paged, $order=array('discountPerc DESC'), $deep=true);			   	
		}
		  		   
    	// Definisce le variabili per il viewer
    	$this->view->assign(array(
            		'topCategories' => $topCats,
    				'selectedTopCat' => (is_null($topId) ? null : $this->_catalogModel->getCatById($topId)->name),
            		'subCategories' => $subCats,
            		'products' => $prods
            		)
        );*/
        
        
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
                        'action'     => 'login'
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
        
        $request = $this->getRequest();
        if (!$request->isPost()) {
            /* Setto anche il layout del login oltre al reindirizzamento */
            $this->_helper->layout->setLayout('login');
            return $this->_helper->redirector('login');
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

