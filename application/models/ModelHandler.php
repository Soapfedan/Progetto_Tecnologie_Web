<?php

class Application_Model_ModelHandler extends App_Model_Abstract
{ 

	public function __construct()
    {
		$this->_logger = Zend_Registry::get('log');  	
	}

    //FAQ

    public function extractFaq()
    {
		return $this->getResource('Faq')->extractFaq();
    }
   
    //PIANO DI FUGA
   
    public function getEscapePlan($zone,$floor)
    {
        return $this->getResource('PianodiFuga')->getEscapePlan($zone,$floor);
    }
   
    //PIANO DELL'IMMOBILE
   
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
    
     public function  checkEvacuation($floor,$imm)
    {
        return $this->getResource('PianoImmobile')-> checkEvacuation($floor,$imm);
    }
    
    //REGISTRO DELLE POSIZIONI
    
     public function  getFloorNumPeople($floor)
    {
        return $this->getResource('RegistroPosizione')-> getFloorNumPeople($floor);
    }
    
     public function  getZoneNumPeople($zone,$floor)
    {
        return $this->getResource('RegistroPosizione')-> getZoneNumPeople($zone,$floor);
    }
    
    
     public function  getPosition($username)
    {
        return $this->getResource('RegistroPosizione')-> getPosition($username);
    }
    
    
      public function  getZonesInformation($floor,$immo,$zone)
    {
        return $this->getResource('Segnalazione')-> getZonesInformation($floor,$immo,$zone);
    }
    
      public function  getPosition($username)
    {
        return $this->getResource('Segnalazione')-> getZonesAlertsNumb($floor,$immo);
    }
    
      public function  getUserInformation($username)
    {
        return $this->getResource('User')-> getPosition($username);
    }
    
      public function  getAllUsers()
    {
        return $this->getResource('User')-> getAllUsers();
    }
    
}