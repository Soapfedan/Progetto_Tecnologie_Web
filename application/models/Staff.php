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
        return $this->getResource('Catastrofe')->setAlternativePlan($zone,$floor,$plan);
    }
    
    /*
     * -------------------------PIANO DELL'IMMOBILE----------------------------------
     */ 
     
      public function  getSociety($imm) 
    {
        return $this->getResource('PianoImmobile')-> getSociety($imm);
    }
    
     public function  getImms($society)
    {
        return $this->getResource('PianoImmobile')-> getImms($society);
    }
   
   
      public function  getFloors($imm)
    {
        return $this->getResource('PianoImmobile')-> getFloors($imm);
    }
    
     public function  getMap($floor,$imm)
    {
        return $this->getResource('PianoImmobile')-> getMap($floor,$imm);
    }
    
     public function  getMapMapped($floor,$imm)
    {
        return $this->getResource('PianoImmobile')-> getMapMapped($floor,$imm);
    }
    
}