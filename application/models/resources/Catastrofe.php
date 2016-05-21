<?php

class Application_Resource_Catastrofe extends Zend_Db_Table_Abstract
{
    protected $_name     = 'tipo_catastrofi';
    protected $_primary  = 'Id_Catastrofe';
    protected $_rowClass = 'Application_Resource_Catastrofe_Item';
    
	public function init()
    {
    }

    //estrae tutte le catastrofi
    
    public function extractDisaster()
    {
        $select = $this->select()
                        ->order('Id_Catastrofe');
        return $this->fetchAll($select);
    }
    
    //inserisce una nuova catastrofe
    
    public function insertDisaster($data)
    {
        $data[0]=$this->lastSequenceId('Id_Catastrofe');
        $this->insert($data);
    }
    
    //modifica una catastrofe
    
    public function modifyDisaster($cat,$id)
    {
        $data=array('Descrizione'=>$cat);
        $where = $table->getAdapter()->quoteInto('Id_Catastrofe = ?', $id);
        $this->update($data,$where);
    }
    
    //elimina una catastrofe
    
    public function deleteDisaster($id)
    {
        $where = $table->getAdapter()->quoteInto('Id_Catastrofe = ?', $id);
        $this->delete($where);
    }
   
}

