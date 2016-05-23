<?php

class PublicController extends Zend_Controller_Action
{
	protected $_catalogModel;
	
    public function init()
    {
		$this->_helper->layout->setLayout('main');
        $this->view->productForm = $this->getProductForm();
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
    
    private function getProductForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_form = new Application_Form_Admin_Product_Add();
        $this->_form->setAction($urlHelper->url(array(
                        'controller' => 'user',
                        'action'     => 'welcome'
                        ), 
                        'default',true
                    ));
        return $this->_form;
    }

    public function loginAction(){
        $this->_helper->layout->setLayout('login');
       
    }
}

