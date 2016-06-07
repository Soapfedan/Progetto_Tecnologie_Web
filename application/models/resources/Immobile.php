<?php

class Application_Resource_Immobile extends Zend_Db_Table_Abstract
{
    protected $_name    = 'immobile';
    protected $_primary  = 'Id';
    protected $_rowClass = 'Application_Resource_Immobile_Item';
    
	public function init()
    {
    }
    
}