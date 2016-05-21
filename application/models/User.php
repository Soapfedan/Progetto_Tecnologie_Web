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
    
    /*
     * ---------------------PIANO DELL'IMMOBILE-----------------------
     */
     
     //Verifica se su un piano è stata dichiarata l'evacuazione
    public function checkEvacuationState($floor,$imm){
        
       return $this->getResource('PianoImmobile')->checkEvacuationState($floor,$imm);
        
    }
}