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
    
    public function insertFaq($faq)
    {
        $id=$this->lastSequenceId('ID');
        $this->insert(array('ID'=>$id,
                            'Question'=>$faq[0],
                            'Answer'=>$faq[1]));
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

