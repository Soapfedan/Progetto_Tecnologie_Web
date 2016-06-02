<?php

class Application_Model_Staff extends App_Model_Abstract
{ 

	public function __construct()
    {
		$this->_logger = Zend_Registry::get('log');  	
	}
    
    /*
     * -------------------CATASTROFE---------------------
     */
    
     //estrae tutte le catastrofi
    
    public function extractDisaster()
    {
        return $this->getResource('Catastrofe')->extractDisaster();
    }  
    
     //modifica una catastrofe
    
    public function modifyDisaster($cat,$id)
    {
        return $this->getResource('Catastrofe')->modifyDisaster($cat,$id);
    }
    
    //elimina una catastrofe
    
    public function deleteDisaster($id)
    {
        return $this->getResource('Catastrofe')->deleteDisaster($id);
    }       
    
    
    
    /*
     * --------------------------PIANO DI FUGA--------------------------
     */    
     
     
     public function setAlternativePlan($zone,$floor,$plan=null) 
    {
        return $this->getResource('PianodiFuga')->setAlternativePlan($zone,$floor,$plan);
    }
    
     public function  getMapMapped($floor,$imm)
    {
        return $this->getResource('PianodiFuga')->getMapMapped($floor,$imm);
    }
    
    /*
     * -------------------------PIANO DELL'IMMOBILE----------------------------------
     */ 
     
      public function  getCompany($imm) 
    {
        return $this->getResource('PianoImmobile')->getCompany($imm);
    }
    
     public function  getImms($company)
    {
        return $this->getResource('PianoImmobile')->getImms($company);
    }
   
   
      public function  getFloors($imm)
    {
        return $this->getResource('PianoImmobile')->getFloors($imm);
    }
    
     public function  getMap($floor,$imm)
    {
        return $this->getResource('PianoImmobile')->getMap($floor,$imm);
    }
    
    
    
    
    public function setEvacuationState($floor,$imm,$state=0){
                
           return $this->getResource('PianoImmobile')->setEvacuationState($floor,$imm,$state);
    }
    
    /*
     * ---------------------REGISTRO DELLA POSIZIONE----------------------
     */
     
      public function  getFloorNumPeople($floor)
    {
        return $this->getResource('RegistroPosizione')-> getFloorNumPeople($floor);
    }
    
     public function  getZoneNumPeople($zone,$floor)
    {
        return $this->getResource('RegistroPosizione')-> getZoneNumPeople($zone,$floor);
    }
    
    /*
     * ------------------------SEGNALAZIONE--------------------
     */
    
     public function  getZonesInformation($floor,$immo,$zone)
    {
        return $this->getResource('Segnalazione')-> getZonesInformation($floor,$immo,$zone);
    }
    
      public function  getPosition($username)
    {
        return $this->getResource('Segnalazione')-> getZonesAlertsNumb($floor,$immo);
    }
    
        
     public function deleteAlert($cod){
        
        return $this->getResource('Segnalazione')->deleteAlert($cod);
    }
    
}