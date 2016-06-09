<?php

class Application_Resource_Immobile extends Zend_Db_Table_Abstract
{
    protected $_name    = 'immobile';
    protected $_primary  = 'Id';
    protected $_rowClass = 'Application_Resource_Immobile_Item';
    
	public function init()
    {
    }
    
    public function getAllBuildings(){
        $select = $this->select()
                       ->from(array('p' => 'immobile'),
                              array('Id', 'Nome'));
        return $this->fetchAll($select);
    }
    
    public function getBuilding($imm){
        $select = $this->select()
                       ->where('Id = ?', $imm); 
        $result = $this->fetchRow($select);
        return $result;
    }
    
    public function updateBuilding($data){
        $where = $this->getAdapter()->quoteInto('Id = ?', $data['Id']);        
        
        $this->update($data,$where);
    }
    
    public function insertBuilding($data){
        // devo estrarre il numero di elementi della tabella e
        // genero l'id aumentandolo di uno
        $maxid = $this -> select()
                       -> from('immobile', array("id" => "MAX(Id)"));
        $result = $this->fetchRow($maxid);
        
        $data['Id']= $result['id'] + 1;
        
        $this->insert($data);
    }
    
    public function deleteBuilding($imm){
        $where[] = $this->getAdapter()->quoteInto('Id = ?', $imm);
        $this->delete($where);
    }
    
}