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
    public function getCompany($imm){
        
        $select = $this->select()
                        ->from('piano_immobile','Societa')
                        ->where('Immobile =?',$imm);
        return $this->fetchRow($select);
        
    }
    
    //estrae tutti gli immobili di quella società
    
    public function getImms($company){
        $select = $this->select()
                        ->from('piano_immobile','Immobile')
                        ->where('Societa =?',$company);
        return $this->fetchAll($select);
    }
    
     //estrae tutti gli immobili 
    /* SELECT DISTINCT p.Immobile
     * FROM piano_immobile AS p
     */
    public function getallImms(){
        $select = $this->select()
                       ->distinct()
                       ->from(array('p' => 'piano_immobile'),
                              array('Immobile'));
                       
        return $this->fetchAll($select);
    }
    
    //restituisce tutti i piani di quell'immobile
    
    public function getFloors($imm){
        $select = $this->select()
                        ->distinct()
                        ->from(array('p' => 'piano_immobile'),
                              array('Id_piano'))
                        ->where('Immobile =?',$imm);
        return $this->fetchAll($select);
    }
    
    //Restituisce la mappa di quel piano
    
    public function getMap($floor,$imm){
        
        $select = $this->select()
                        ->from(array('p' => 'piano_immobile'),
                              array('Mappa'))
                        ->where('Immobile =?',$imm)
                        ->where('Id_piano =?',$floor);
                        
        return $this->fetchRow($select);
    }
    
    //Verifica se su un piano è stata dichiarata l'evacuazione
    public function checkEvacuationState($floor,$imm){
        
        $select = $this->select()
                        ->from('piano_immobile','Evacuazione')
                        ->where('Immobile =?',$imm)
                        ->where('Id_piano =?',$floor);
        return $this->fetchRow($select);
        
    }
    
    //va a cambiare la mappa di un piano e la sua mappatura
    public function setMap($map,$mapschema,$floor,$imm){
        
            $data=array('Mappa'=>$map,'Mappatura_zone'=>$mapschema);
            $where[] = $this->getAdapter()->quoteInto('Immobile = ?', $imm);
            $where[] = $this->getAdapter()->quoteInto('Id_piano = ?', $floor);
            $this->update($data,$where);
    }
    
    //setta lo stato di evacuazione di un piano
    public function setEvacuationState($floor,$imm,$state=0){
                
            $where[] = $this->getAdapter()->quoteInto('Immobile = ?', $imm);
            $where[] = $this->getAdapter()->quoteInto('Id_piano = ?', $floor);
            $this->update($state,$where);
    }
    
    //elimina un piano
    public function deleteFloor($floor,$imm){
        $where[] = $this->getAdapter()->quoteInto('Immobile = ?', $imm);
        $where[] = $this->getAdapter()->quoteInto('Id_piano = ?', $floor);
        $this->delete($where);
    }
    
    
    //inserisce un nuovo piano
    public function insertFloor($floordata){
        $this->insert($floordata);
    }
    
    //elimina un immobile
    public function deleteBuilding($immid){
        $where[] = $this->getAdapter()->quoteInto('Immobile = ?', $immid);
        $this->delete($where);
    }
}

