<?php

class Application_Resource_RegistroPosizione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'registro_posizione';
    protected $_primary  = 'Utente';
    protected $_rowClass = 'Application_Resource_RegistroPosizione_Item';
    
	public function init()
    {
    }
    
    //Estrae il numero di persone per piano
    
    public function getFloorNumPeople($floor){
        
        $select = $this->select()
                       ->from("registro_posizione", array("Num"=>"COUNT(*)"))
                       ->where('Id_piano =?',$floor);                       
                       
         $result=$this->fetch($select);
        
         return $result["Num"];
        
    }
    
    //Estrae il numero di persone per zona
    
    public function getZoneNumPeople($zone,$floor){
            
        $select = $this->select()
                       ->from("registro_posizione", array("Num"=>"COUNT(Zona)"))
                       ->where('Id_piano =?',$floor)                       
                       ->where('Zona =?',$zone)
                       ->group('Zona')
                       ->order('Zona'); 
         return $this->fetchAll($select);
        
         
    }
    
    //Estrae la posizione di un utente
    
    public function getPosition($username){
        
        $select = $this->select()
                       ->where('Utente =?',$username);                       
                       
        return $this->fetch($select);
        
        
    }
}

