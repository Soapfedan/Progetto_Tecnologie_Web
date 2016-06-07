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
    
    public function getZonesAlertsNumb($zone,$floor,$immo){
        $select = $this->select()
                        ->from('segnalazione',array("Num"=>"COUNT(Tipo_Catastrofe)",
                                                    'Immobile'=>'Immobile',
                                                     'Id_Piano'=>'Id_Piano',
                                                      'Codice_Zona'    =>'Codice_Zona'))
                        ->where('Id_Piano =?',$floor)
                        ->where('Immobile =?',$immo)
                        ->where('Codice_Zona =?',$zone)
                        ->group('Immobile')
                        ->group('Id_Piano')
                        ->group('Codice_Zona')
                        ->order('Immobile')
                        ->order('Id_Piano')
                        ->order('Codice_Zona');
        
        $result=$this->fetchAll($select);
        
         return $result;
    }
    
    //inserisce una nuova segnalazione
    public function insertAlert($data){
        
        // devo estrarre il numero di elementi della tabella e
        // genero l'id aumentandolo di uno
        $maxid = $this -> select()
                       -> from('segnalazione', array("id" => "MAX(Codice_Segnalazione)"));
        $result = $this->fetchRow($maxid);
        $data['Codice_Segnalazione']=$result['id']+1;
        $this->insert($data);
    }

    public function deleteAlert($cod){
        
        $where = $this->getAdapter()->quoteInto('Codice_Segnalazione = ?', $cod);
        $this->delete($where);
    }
    
    public function getAlert($imm){
    	$select = $this->select()
						->where('Immobile =?',$imm)
                        ->order('Immobile')
                        ->order('Id_Piano')
                        ->order('Codice_Zona')
                        ->order('Data_Segnalazione')
                        ->order('Ora_Segnalazione')
                        ->order('Tipo_Catastrofe');
		return $this->fetchAll($select);
    }
}

