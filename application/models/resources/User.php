<?php

class Application_Resource_User extends Zend_Db_Table_Abstract
{
    protected $_name    = 'user';
    protected $_primary  = 'Username';
    protected $_rowClass = 'Application_Resource_User_Item';
    
	public function init()
    {
    }

    //Estrazione di tutte le informazioni dell'utente

    public function getUserInformation($username){
        $select = $this->select()
                        ->where('Username =?',$username);
        return $this->fetch($select);
    }
    
    //Estrae tutte le infomazioni di tutti gli utenti
    public function getAllUsers(){
        
        $select = $this->select()
                       ->order('Cognome')
                       ->order('Nome')
                       ->order('Username');
        return $this->fetchAll($select);
        
    }
   
}

