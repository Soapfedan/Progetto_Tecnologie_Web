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
        // devo estrarre il numero di elementi della tabella e
        // genero l'id aumentandolo di uno
        $maxid = $this -> select()
                       -> from('faq', array("id" => "MAX(ID)"));
        $result = $this->fetchRow($maxid);
        
        $data['ID']= $result['id'] + 1;
        //var_dump($data);
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
   
   public function extractFaqById($id)
    {
        $select = $this->select()
                        ->where('ID = ?', $id);
        return $this->fetchRow($select);
    }
}

