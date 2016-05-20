<?php

class UserController extends Zend_Controller_Action
{
	protected $_catalogModel;
	
    public function init()
    {
		//$this->_catalogModel = new Application_Model_Admin();  
        $this->view->productForm = $this->getProductForm();
    }

    public function indexAction()
    {
        $this->_helper->layout->setLayout('login');
         $this->render("index");
    }
 	
    public function viewstaticAction () {
    	$page = $this->_getParam('staticPage');
    	$this->render($page);
    }
    
    public function loggedAction(){
        $this->_helper->layout->setLayout('arear');
        $this->render("logged");
    }
    
  private function getProductForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_form = new Application_Form_Admin_Product_Add();
        $this->_form->setAction($urlHelper->url(array(
                        'controller' => 'public',
                        'action'     => 'viewstatic',
                        'staticPage' => 'index'
                        ), 
                        'default',true
                    ));
        return $this->_form;
    }
}

