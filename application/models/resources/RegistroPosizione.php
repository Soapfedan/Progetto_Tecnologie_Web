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
    
    public function getFloorNumPeople($imm,$floor){
        
        $select = $this->select()
                       ->from("registro_posizione", array("Num"=>"COUNT(Utente)",
                                                    'Immobile'=>'Immobile',
                                                    'Id_piano'=>'Id_piano'
                                                    ))
                       ->where('Immobile =?',$imm)
                       ->where('Id_piano =?',$floor)
                       ->group('Immobile')
                       ->group('Id_piano')
                       ->order('Immobile')
                       ->order('Id_piano');
         $result=$this->fetchRow($select);
        
         return $result;
        
    }
    
    //Estrae il numero di persone per zona
    
    public function getZoneNumPeople($zone,$floor,$imm){
            
        $select = $this->select()
                       ->from("registro_posizione", array("Num"=>"COUNT(Zona)",
                                                          'Immobile'=>'Immobile',
                                                          'Id_piano'=>'Id_piano',
                                                          'Zona'    =>'Zona'))
                       ->where('Id_piano =?',$floor)                       
                       ->where('Zona =?',$zone)
                       ->where('Immobile =?',$imm)
                       ->group('Immobile')
                       ->group('Id_piano')
                       ->group('Zona')
                       ->order('Immobile')
                       ->order('Id_piano')
                       ->order('Zona'); 
         return $this->fetchAll($select);
        
         
    }
    
    //Estrae la posizione di un utente
    
    public function getPosition($username){
        
        $select = $this->select()
                       ->where('Utente =?',$username);                       
                       
        return $this->fetchRow($select);
        
        
    }
    
    //inserisce la posizione iniziale di un utente
    public function insertPosition($data){
        
        $this->insert($data);
             
    }
    //modifica la posizione dell'utente
     public function updatePosition($data){
        
        
        $where = $this->getAdapter()->quoteInto('Utente = ?', $data['Utente']);
        $this->update($data,$where);
               
        
    }
     //elimina la posizione di quell'utente
      public function deletePosition($username){
        
        $where = $this->getAdapter()->quoteInto('Utente = ?', $username);
        $this->delete($where);     
        
    }
    
}

