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
        
        $data=array('Data_di_Nascita'=>$form['data'],
                    'Citta'=>$form['citta'],
                    'Provincia'=>$form['provincia'],
                    'Genere'=>$form['genere'],
                    'Codice_fiscale'=>$form['codfis'],
                    'Email'=>$form['email'],
                    'Telefono'=>$form['tel']);
                      
        $where = $table->getAdapter()->quoteInto('Username = ?',$form['username']);
        $this->update($data,$where);
    }
    
      
    //inserisce un nuovo utente
    public function insertNewUser($data){
        
        $this->insert($data);
        
    }   
    
    //permette all'amministratore di modificare i dati di un utente 
    
    public function updateAllUserInformation($form){
            
        $data=array('Username'=>$form['newuser'],
                    'Password'=>$form['password'],
                    'Nome'=>$form['nome'],
                    'Cognome'=>$form['cognome'],
                    'Data_di_Nascita'=>$form['data'],
                    'Citta'=>$form['citta'],
                    'Provincia'=>$form['provincia'],
                    'Genere'=>$form['genere'],
                    'Codice_fiscale'=>$form['codfis'],
                    'Email'=>$form['email'],
                    'Telefono'=>$form['tel'],
                    'Categoria'=>$form['cat'],
                    'Societa_staff'=>$form['societa']);
        $where = $table->getAdapter()->quoteInto('Username = ?',$form['olduser']);
        $this->update($data,$where);
    }   
    
    public function updatePassword($form){
            
        $where = $table->getAdapter()->quoteInto('Username = ?',$form['username']);
        $this->update($form['password'],$where);
    }
    
    public function deleteUser($username){
        
        $where = $table->getAdapter()->quoteInto('Username = ?', $username);
        $this->delete($where);
    }
}

