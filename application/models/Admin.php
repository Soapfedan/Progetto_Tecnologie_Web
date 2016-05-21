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
    
      public function modifyFaq($faq,$id)
    {
        return $this->getResource('Faq')->modifyFaq($faq,$id);
    }
    
    
      public function deleteFaq($faq)
    {
        return $this->getResource('Faq')->deleteFaq($faq);
    }
    
   
    /*
     * ----------------------PIANO DI FUGA-----------------------
     */
   
   public function getZone($zone,$floor)
    {
        return $this->getResource('PianodiFuga')->getZone($zone,$floor);
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
   
    //PIANO DELL'IMMOBILE
   
   
   
    
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