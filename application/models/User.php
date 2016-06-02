<?php

class Application_Model_User extends App_Model_Abstract
{ 

	public function __construct()
    {
		$this->_logger = Zend_Registry::get('log');  	
	}
    
    /*
     * ------------------ CATASTROFE-------------------------
     */
    
    public function insertDisaster($data)
    {
        return $this->getResource('Catastrofe')->insertDisaster($data);
    }
    
    /*
     * --------------------PIANO DI FUGA-----------------------
     */
    
     public function getEscapePlan($zone,$floor)
    {
        return $this->getResource('PianodiFuga')->getEscapePlan($zone,$floor);
    }
    
     public function  getMapMapped($floor,$imm)
    {
        return $this->getResource('PianodiFuga')->getMapMapped($floor,$imm);
    }
	
	public function getAllZone($imm,$floor){
		return $this->getResource('PianodiFuga')->getZone($imm,$floor);
	}
    
    /*
     * ---------------------PIANO DELL'IMMOBILE-----------------------
     */
     
    public function checkEvacuationState($floor,$imm){
        
       return $this->getResource('PianoImmobile')->checkEvacuationState($floor,$imm);
        
    }
    
    
    public function getallImms(){
        
       return $this->getResource('PianoImmobile')->getallImms();
        
    }
    
     public function  getFloors($imm)
    {
        return $this->getResource('PianoImmobile')->getFloors($imm);
    }
    
    public function  getMap($floor,$imm)
    {
        return $this->getResource('PianoImmobile')->getMap($floor,$imm);
    }
     /*
     * ---------------------REGISTRO DELLA POSIZIONE----------------------
     */
     
      public function  getPosition($username)
    {
        return $this->getResource('RegistroPosizione')->getPosition($username);
    }
    
    
    //inserisce la posizione iniziale di un utente
    public function insertPosition($data){
        
       return $this->getResource('RegistroPosizione')->insertPosition($data);
             
    }
    //modifica la posizione dell'utente
     public function updatePosition($data){
        
        return $this->getResource('RegistroPosizione')->updatePosition($data);
               
        
    }
     //elimina la posizione di quell'utente
      public function deletePosition($username){
        
       return $this->getResource('RegistroPosizione')->deletePosition($username);
        
    }
      
      /*
       * -------------------SEGNALAZIONE-------------------
       */
       
        public function insertAlert($data){
        
          return $this->getResource('Segnalazione')->insertAlert($data);
        }
        
       /*
        * ------------------UTENTE-------------------------
        */
        
        public function getUserInformation($username){
       
            return $this->getResource('User')->getUserInformation($username);
        }
        
        //da la possibilita' all'utente (registrato e staff) di modificare i propri dati (eccetto l'username,la password,
        // il nome, il cognome, la societa' di appartenenza e la categoria)
        public function updateUserInformation($form,$username){
        
              return $this->getResource('User')->updateUserInformation($form);
         }
        
        //inserisce un nuovo utente
         public function insertNewUser($data){
        
            return $this->getResource('User')->insertNewUser($data);
        
        } 
         
         public function updatePassword($form){
            
            return $this->getResource('User')->updatePassword($form);
        } 
        
}