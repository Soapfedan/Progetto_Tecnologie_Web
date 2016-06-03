<?php

class Application_Resource_Segnalazione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'segnalazione';
    protected $_primary  = 'Codice_Segnalazione';
    protected $_rowClass = 'Application_Resource_Segnalazione_Item';
    
	public function init()
    {
    }
    
    //estrae tutte le segnalazioni per quella zona catalogate per segnalazione
    
    public function getZonesInformation($floor,$immo,$zone){
        $select = $this->select()
                        ->where('Id_piano =?',$floor)
                        ->where('Immobile =?',$immo)
                        ->where('Codice_Zona =?',$zone)
                        ->group('Tipo_Catastrofe');
        return $this->fetchAll($select);
    }
    
    //estrae il numero di segnalazioni per zona
    
    public function getZonesAlertsNumb($floor,$immo){
        $select = $this->select()
                        ->from('segnalazione',array("Num"=>"COUNT(Tipo_Catastrofe)","Catastrofe"=>"Tipo_Catastrofe"))
                        ->where('Id_piano =?',$floor)
                        ->where('Immobile =?',$immo)
                        ->where('Codice_Zona =?',$zone)
                        ->group('Tipo_Catastrofe');
        
        $result=$this->fetchAll($select);
        
         return array($result["Catastrofe"],$result["Num"]);
    }
    
    //inserisce una nuova segnalazione
    public function insertAlert($data){
        
        // devo estrarre il numero di elementi della tabella e
        // genero l'id aumentandolo di uno
        $maxid = $this -> select()
                       -> from('faq', array("id" => "MAX(ID)"));
        $result = $this->fetchRow($maxid);
        $data['Codice_Segnalazione']=$result;
        $this->insert($data);
    }

    public function deleteAlert($cod){
        
        $where = $this->getAdapter()->quoteInto('Codice_Segnalazione = ?', $cod);
        $this->delete($where);
    }
}

