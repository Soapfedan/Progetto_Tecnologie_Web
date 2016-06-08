<?php

class Application_Resource_Immobile extends Zend_Db_Table_Abstract
{
    protected $_name    = 'immobile';
    protected $_primary  = 'Id';
    protected $_rowClass = 'Application_Resource_Immobile_Item';
    
	public function init()
    {
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
    
}