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
    
    public function getFloorNumPeople($floor,$imm){
        
        $select = $this->select()
                       ->from("registro_posizione", array("Num"=>"COUNT(*)"))
                       ->where('Id_piano =?',$floor)                       
                       ->where('Immobile =?',$imm);
         $result=$this->fetchRow($select);
        
         return $result["Num"];
        
    }
    
    //Estrae il numero di persone per zona
    
    public function getZoneNumPeople($zone,$floor,$imm){
            
        $select = $this->select()
                       ->from("registro_posizione", array("Num"=>"COUNT(Zona)"))
                       ->where('Id_piano =?',$floor)                       
                       ->where('Zona =?',$zone)
                       ->where('Immobile =?',$imm)
                       ->group('Zona')
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
        
        $position=array('Id_piano'=>$data[1],'Zona'=>$data[2],'Immobile'=>$data[3]);
        $where = $table->getAdapter()->quoteInto('Username = ?', $data[0]);
        $this->update($position,$where);
               
        
    }
     //elimina la posizione di quell'utente
      public function deletePosition($username){
        
        $where = $table->getAdapter()->quoteInto('Username = ?', $id);
        $this->delete($where);     
        
    }
    
}

