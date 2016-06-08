<?php

class Application_Model_Admin extends App_Model_Abstract
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
    
    public function insertFaq($faq)
    {
        return $this->getResource('Faq')->insertFaq($faq);
    }
    
      public function modifyFaq($faq)
    {
        return $this->getResource('Faq')->modifyFaq($faq);
    }
    
    
      public function deleteFaq($faq)
    {
        return $this->getResource('Faq')->deleteFaq($faq);
    }
    
   
    /*
     * ----------------------PIANO DI FUGA-----------------------
     */
   
   //resituisce tutti le zone di un piano di un immobile
   public function getAllZones($imm, $floor){
       return $this->getResource('PianodiFuga')->getZone($imm, $floor);
   }
   
   //restituisce una singola zona
   public function getSingleZone($imm,$floor,$zone){
       return $this->getResource('PianodiFuga')->getSingleZone($imm,$floor,$zone);
   }
   
   public function getEscapePlanInfo($zone,$floor,$imm)
    {
        return $this->getResource('PianodiFuga')->getEscapePlanInfo($zone,$floor,$imm);
    }
    
    //inserisce una nuova zona con un nuovo piano di fuga
    public function insertNewZonePlan($zonedata){
         
         return $this->getResource('PianodiFuga')->insertNewZonePlan($zonedata);
    }
   
   //elimina un percorso di fuga per zona
    public function deletePlanbyZone($zone)
    {
        return $this->getResource('PianodiFuga')->deletePlanbyZone($zone);
    }


    //elimina un percorso di fuga per piano
    public function deletePlanbyFloor($floor)
    {
       return $this->getResource('PianodiFuga')->deletePlanbyFloor($floor);
    }
    /*
     * --------------------- IMMOBILE-------------------
     */
     
     // prende una tupla di un immobile
     public function getBuilding($imm){
         return $this->getResource('Immobile')->getBuilding($imm);
     }
     
     // aggiorna un immobile
     public function updateBuilding($data){
         return $this->getResource('Immobile')->updateBuilding($data);
     }
    /*
     * ---------------------PIANO DELL'IMMOBILE-------------------
     */
   
   //va a cambiare la mappa di un piano e la sua mappatura
    public function setMap($map,$floor,$imm){
        
        return $this->getResource('PianoImmobile')->setMap($map,$floor,$imm);
           
    }
    
    //aggiorna un piano
    public function updateFloor($data, $imm, $floor){
        return $this->getResource('PianoImmobile')->updateFloor($data, $imm, $floor);
    }
    
    //elimina un piano
    public function deleteFloor($floor,$imm){
       
       return $this->getResource('PianoImmobile')->deleteFloor($floor,$imm);
    }
    
    
    //inserisce un nuovo piano
    public function insertFloor($floordata){
       
       return $this->getResource('PianoImmobile')->insertFloor($floordata);
    }
    
    // Restituisce tutti i piani di un immobile
    public function getFloors($imm){
        return $this->getResource('PianoImmobile')->getFloors($imm);
    }
    
    // restituisce una tupla della tabella relativa ad dato piano di un dato immobile
    public function getFloorInfo($imm, $floor){
        return $this->getResource('PianoImmobile')->getFloorInfo($imm, $floor);
    }
    
    // Restituisce tutti gli immobili
    public function getAllBuildings(){
        return $this->getResource('PianoImmobile')->getallImms();
    }
    
    // Elimina un immobile
    public function deleteBuilding($id){
        return $this->getResource('PianoImmobile')->deleteBuilding($id);
    }
    /*
     * ---------------------------REGISTRO DELLE POSIZIONI--------------------
     */
    
    
    
    
    
    /*
     * ---------------------------SEGNALAZIONI--------------------
     */
    
     
    /*
     * ------------------------------UTENTI-------------------------
     */
    //Estrae tutte le infomazioni di tutti gli utenti
    
    
      public function  getAllUsers()
    {
        return $this->getResource('User')->getAllUsers();
    }
    
     //permette all'amministratore di modificare i dati di un utente 
    
    public function updateAllUserInformation($form){
            
       return $this->getResource('User')->updateAllUserInformation($form);
    } 
    
    public function deleteUser($username){
        
        return $this->getResource('User')->deleteUser($username);
    }  
    
}