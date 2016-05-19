<?php

class Application_Resource_PianoImmobile extends Zend_Db_Table_Abstract
{
    protected $_name    = 'piano_immobile';
    protected $_primary  = 'Id_piano';
    protected $_rowClass = 'Application_Resource_PianoImmobile_Item';

	public function init()
    {
    }
    
    //estrae la societa a cui appertiene quell'immobile
    public function getSociety($imm){
        
        $select = $this->select()
                        ->from('piano_immobile','Societa')
                        ->where('Immobile =?',$imm);
        return $this->fetch($select);
        
    }
    
    //estrae tutti gli immobili di quella società
    
    public function getImms($society){
        $select = $this->select()
                        ->from('piano_immobile','Immobile')
                        ->where('Societa =?',$society);
        return $this->fetchAll($select);
    }
    
    //restituisce tutti i piani di quell'immobile
    
    public function getFloors($imm){
        $select = $this->select()
                        ->from('piano_immobile','Id_piano')
                        ->where('Immobile =?',$imm);
        return $this->fetchAll($select);
    }
    
    //Restituisce la mappa di quel piano
    
    public function getMap($floor,$imm){
        
        $select = $this->select()
                        ->from('piano_immobile','Mappa')
                        ->where('Immobile =?',$imm)
                        ->where('Id_piano =?',$floor);
        return $this->fetch($select);
    }
    
    //Estrae la cartina del piano di quell'immobile con il relativo codice html della mappatura
    public function getMapMapped($floor,$imm){
        
         $select = $this->select()
                        ->from('piano_immobile',array('Mappa','Mappatura_zone'))
                        ->where('Immobile =?',$imm)
                        ->where('Id_piano =?',$floor);
        return $this->fetch($select);
        
    }
    
    //Verifica se su un piano è stata dichiarata l'evacuazione
    public function checkEvacuation($floor,$imm){
        
        $select = $this->select()
                        ->from('piano_immobile','Evacuazione')
                        ->where('Immobile =?',$imm)
                        ->where('Id_piano =?',$floor);
        return $this->fetch($select);
        
    }
}

