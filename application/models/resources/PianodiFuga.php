<?php

class Application_Resource_PianodiFuga extends Zend_Db_Table_Abstract
{
    protected $_name    = 'piano_di_fuga';
    protected $_primary  = 'Zona';
    protected $_rowClass = 'Application_Resource_PianodiFuga_Item';

	public function init()
    {
    }
    //estrae il piano di fuga relativo ad una zona e ad un piano. Se è stato inserito
    //dallo staff un percorso alternativo sarà visuallizato tale percorso altrimenti quello 
    //di default
    public function getEscapePlan($zone,$floor,$imm){
        
         $select = $this->select()
                        ->from(array('p' => 'piano_di_fuga'),
                         array('Piano_di_fuga', 'Piano_di_fuga_alternativo'))
                        ->where('Zona =?',$zone)
                        ->where('Id_piano =?',$floor)
                        ->where('Immobile =?',$imm);
        $result= $this->fetchRow($select);
         
         return $result;   
            
    }
    
    public function getInfoImms($imms){
        
        $select = $this->select()
                       ->where('Immobile =?', $imms)
                       ->order('Immobile')
                       ->order('Id_piano')
                       ->order('Zona');
        $result = $this->fetchAll($select);
        
        return $result;
    }
    
    public function getEscapePlanInfo($zone,$floor,$imm){
         $select = $this->select()
                        ->where('Zona =?',$zone)
                        ->where('Id_piano =?',$floor)
                        ->where('Immobile =?',$imm);
        $result= $this->fetchRow($select);
         
         return $result; 
    }
    
    
    //restituisce tutte le caratteristiche di quella zona
      public function getZone($imm,$floor){
        
         $select = $this->select()
                        ->where('Immobile =?',$imm)
                        ->where('Id_piano =?',$floor);
                        
       return $this->fetchAll($select);
    }
      
      //restituisce una zona di un piano di un immobile
      public function getSingleZone($imm,$floor,$zone){
        
         $select = $this->select()
                        ->where('Immobile =?',$imm)
                        ->where('Id_piano =?',$floor)
                        ->where('Zona =?', $zone);
                        
       return $this->fetchRow($select);
    }
    
    //settta il piano alternativo e se non è passato niente al parametro $plan lo setta a null
    public function setAlternativePlan($data){
        
        
        $where[] = $this->getAdapter()->quoteInto('Immobile = ?', $data['Immobile']);        
        $where[] = $this->getAdapter()->quoteInto('Zona = ?', $data['Immobile']);
        $where[] = $this->getAdapter()->quoteInto('Id_piano = ?', $data['Id_piano']);
        
        $this->update($data,$where);
    }
    
    //inserisce una nuova zona con un nuovo piano di fuga
    public function insertNewZonePlan($data){
        $maxid = $this -> select()
                       -> from('piano_di_fuga', array("id" => "MAX(Zona)"))
                       -> where('Immobile = ? ', $data['Immobile'])
                       -> where('Id_piano = ? ', $data['Id_piano']);
        $result = $this->fetchRow($maxid);
        
        $data['Zona']= $result['id'] + 1;
        $this->insert($data);
    }
   
   //modifica una zona
    public function updateZone($data, $imm, $f, $z){
        $where []= $this->getAdapter()->quoteInto('Immobile = ?', $imm);//$data['Immobile']);        
        $where []= $this->getAdapter()->quoteInto('Id_piano = ?', $f); //$data['Id_piano']);
        $where []= $this->getAdapter()->quoteInto('Zona = ?', $z); //$data['Zona']);
        
        $this->update($data,$where);
    }
   
   //elimina un percorso di fuga per zona
    public function deletePlanbyZone($imm, $floor, $zone)
    {
        $where[] = $this->getAdapter()->quoteInto('Id_piano = ?', $floor);
        $where[] = $this->getAdapter()->quoteInto('Immobile = ?', $imm);
        $where[] = $this->getAdapter()->quoteInto('Zona = ?', $zone);
        $this->delete($where);
    }

    public function deleteFloor($floor, $imm){
        $where[] = $this->getAdapter()->quoteInto('Id_piano = ?', $floor);
        $where[] = $this->getAdapter()->quoteInto('Immobile = ?', $imm);
        $this->delete($where);
    }
    
    public function deleteBuilding($imm){
        $where[] = $this->getAdapter()->quoteInto('Immobile = ?', $imm);
        $this->delete($where);
    }
    
    //elimina un percorso di fuga per piano
    public function deletePlanbyFloor($floor)
    {
        $where = $this->getAdapter()->quoteInto('Id_piano = ?', $floor);
        $this->delete($where);
    }
    
    //Estrae la cartina del piano di quell'immobile con il relativo codice html della mappatura
    public function getMapMapped($floor,$imm){
        
         $select = $this->select()
                        ->from(array('p' => 'piano_di_fuga'),
                                     array('Zona','Mappatura_zona'))
                        ->where('Immobile =?',$imm)
                        ->where('Id_piano =?',$floor);
        return $this->fetchAll($select);
        
    }
    
    //
	
}

