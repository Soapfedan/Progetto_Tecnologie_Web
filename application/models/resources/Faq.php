<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name     = 'faq';
    protected $_primary  = 'ID';
    protected $_rowClass = 'Application_Resource_Faq_Item';
    
	public function init()
    {
    }

    //estrae tutte le faq
    
    public function extractFaq()
    {
        $select = $this->select()
                        ->order('ID');
        return $this->fetchAll($select);
    }
    
    //inserisce una nuova faq
    
    public function insertFaq($data)
    {
         $data[0]=$this->lastSequenceId('ID');
        $this->insert($data);
    }
    
    //modifica una faq
    
    public function modifyFaq($faq)
    {
       
        $where = $this->getAdapter()->quoteInto('ID = ?', $faq['ID']);
        $this->update($faq,$where);
    }
    
    //elimina una faq
    
    public function deleteFaq($id)
    {
        $where = $this->getAdapter()->quoteInto('ID = ?', $id);
        $this->delete($where);
    }
   
}

