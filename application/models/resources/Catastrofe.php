<?php

class Application_Resource_Catastrofe extends Zend_Db_Table_Abstract
{
    protected $_name     = 'tipo_catastrofi';
    protected $_primary  = 'Id_Catastrofe';
    protected $_rowClass = 'Application_Resource_Catastrofe_Item';
    
	public function init()
    {
    }

    //estrae tutte le faq
    
    public function extractCatastrofe()
    {
        $select = $this->select()
                        ->order('Id_Catastrofe');
        return $this->fetchAll($select);
    }
    
    //inserisce una nuova faq
    
    public function insertCatastrofe($cat)
    {
        $id=$this->lastSequenceId('ID');
        $this->insert(array('ID'=>$id,
                            'Descrizione'=>$cat));
    }
    
    //modifica una faq
    
    public function modifyFaq($faq,$id)
    {
        $data=array('Question'=>$faq[0],'Answer'=>$faq[1]);
        $where = $table->getAdapter()->quoteInto('ID = ?', $id);
        $this->update($data,$where);
    }
    
    //elimina una faq
    
    public function deleteFaq($id)
    {
        $where = $table->getAdapter()->quoteInto('ID = ?', $id);
        $this->delete($where);
    }
   
}

