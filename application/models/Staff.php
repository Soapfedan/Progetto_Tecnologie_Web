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
     
     
     public function setAlternativePlan($data) 
    {
        return $this->getResource('PianodiFuga')->setAlternativePlan($data);
    }
    
     public function  getMapMapped($floor,$imm)
    {
        return $this->getResource('PianodiFuga')->getMapMapped($floor,$imm);
    }
    
    public function getZone($zone,$floor)
    {
        return $this->getResource('PianodiFuga')->getZone($zone,$floor);
    }
    
    public function getEscapePlanInfo($zone,$floor,$imm)
    {
        return $this->getResource('PianodiFuga')->getEscapePlanInfo($zone,$floor,$imm);
    }
    
    public function getInfoImms($imms)
    {
        return $this->getResource('PianodiFuga')->getInfoImms($imms);
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
     
      public function  getFloorNumPeople($imm,$floor)
    {
        return $this->getResource('RegistroPosizione')-> getFloorNumPeople($imm,$floor);
    }
    
     public function  getZoneNumPeople($zone,$floor,$imm)
    {
        return $this->getResource('RegistroPosizione')-> getZoneNumPeople($zone,$floor,$imm);
    }
    
    /*
     * ------------------------SEGNALAZIONE--------------------
     */
    
     public function  getZonesInformation($floor,$immo,$zone)
    {
        return $this->getResource('Segnalazione')-> getZonesInformation($floor,$immo,$zone);
    }
    
      public function  getZonesAlertsNumb($zone,$floor,$immo)
    {
        return $this->getResource('Segnalazione')-> getZonesAlertsNumb($zone,$floor,$immo);
    }
    
    
    
        
     public function deleteAlert($cod){
        
        return $this->getResource('Segnalazione')->deleteAlert($cod);
    }

    //restituisce gli allert per quel determinato immobile
	public function getAlert($imm){
		return $this->getResource('Segnalazione')->getAlert($imm);
	}
}