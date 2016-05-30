<?php

class Application_Model_Public extends App_Model_Abstract
{ 

	public function __construct()
    {
		$this->_logger = Zend_Registry::get('log');  	
	}

    /*
     * --------------------FAQ-------------------
     */

    public function extractFaq()
    {
		return $this->getResource('Faq')->extractFaq();
    }
    
       //inserisce un nuovo utente
       public function insertNewUser($data){
        
            return $this->getResource('User')->insertNewUser($data);
        
        } 
         
}