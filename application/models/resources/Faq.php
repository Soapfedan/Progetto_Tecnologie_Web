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
}

