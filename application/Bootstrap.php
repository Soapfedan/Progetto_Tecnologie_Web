<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected $_logger;
	protected $_view;

	protected function _initLogging()
    {
        $logger = new Zend_Log();
        $writer = new Zend_Log_Writer_Firebug();
        $logger->addWriter($writer);

        Zend_Registry::set('log', $logger);

        $this->_logger = $logger;
    		$this->_logger->info('Bootstrap ' . __METHOD__);
    }

    protected function _initRequest()
	// Aggiunge un'istanza di Zend_Controller_Request_Http nel Front_Controller
	// che permette di utilizzare l'helper baseUrl() nel Bootstrap.php
	// Necessario solo se la Document-root di Apache non è la cartella public/
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
    }

    protected function _initViewSettings()
    {
        $this->bootstrap('view');
        $this->_view = $this->getResource('view');
        $this->_view->headMeta()->setCharset('UTF-8');
        $this->_view->headMeta()->appendHttpEquiv('Content-Language', 'it-IT');
        $this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/default.css'));
        $this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/fonts.css'));
        $this->_view->headScript()->appendScript('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js');
        //$this->_view->headLink()->appendStylesheet($this->_view->baseUrl('http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900'));
        $this->_view->headTitle('Sito Tecnologie Web');
        
    }
    
    protected function _initDefaultModuleAutoloader()
    {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('App_');
        $this->getResourceLoader()
             ->addResourceType('modelResource','models/resources','Resource');  
    }
    
    protected function _initDbParms()
    {
        include_once (APPLICATION_PATH . '/../../include/connectZP.php');
        $db = new Zend_Db_Adapter_Pdo_Mysql(array(
                'host'     => $HOST,
                'username' => $USER,
                'password' => $PASSWORD,
                'dbname'   => $DB
                ));  
        Zend_Db_Table_Abstract::setDefaultAdapter($db);
    }
    
    
}
