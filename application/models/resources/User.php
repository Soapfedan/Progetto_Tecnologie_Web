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
        return $this->fetchRow($select);
    }
    
    //Estrae tutte le infomazioni di tutti gli utenti
    public function getAllUsers(){
        
        $select = $this->select()
                       ->order('Cognome')
                       ->order('Nome')
                       ->order('Username');
        return $this->fetchAll($select);
        
    }
    //da la possibilita' all'utente (registrato e staff) di modificare i propri dati (eccetto l'username,la password,
    // il nome, il cognome, la societa' di appartenenza e la categoria)
    public function updateUserInformation($form){
       
        $where = $this->getAdapter()->quoteInto('Username = ?', $form['Username']);
        $this->update($form,$where);
    }
    
      
    //inserisce un nuovo utente
    public function insertNewUser($data){
        
        $this->insert($data);
        
    }   
    
    //permette all'amministratore di modificare i dati di un utente 
    
    public function updateAllUserInformation($form,$olduser){
            
        
        $where = $this->getAdapter()->quoteInto('Username = ?',$olduser);
        $this->update($data,$where);
    }   
    
    public function updatePassword($form){
            
        $where = $this->getAdapter()->quoteInto('Username = ?',$form['username']);
        $this->update($form['password'],$where);
    }
    
    public function deleteUser($username){
        
        $where = $this->getAdapter()->quoteInto('Username = ?', $username);
        $this->delete($where);
    }
}

