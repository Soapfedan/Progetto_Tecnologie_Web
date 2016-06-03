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
      /*
     * --------------------PIANO DELL'IMMOBILE-------------------
     */ 
      public function getallImms(){
        
            return $this->getResource('PianoImmobile')->getallImms();
        
      } 
      
      public function  getFloors($imm){
            return $this->getResource('PianoImmobile')->getFloors($imm);
      }
      
      public function  getMap($floor,$imm){
            return $this->getResource('PianoImmobile')->getMap($floor,$imm);
      }
      
     /*
     * --------------------PIANO DI FUGA-------------------
     */ 
     public function  getMapMapped($floor,$imm){
        return $this->getResource('PianodiFuga')->getMapMapped($floor,$imm);
     }
     /*
     * --------------------POSIZIONE-------------------
     */ 
     //inserisce la posizione iniziale di un utente
     public function insertPosition($data){
        
       return $this->getResource('RegistroPosizione')->insertPosition($data);
             
    }  
         
}