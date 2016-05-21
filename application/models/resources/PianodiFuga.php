<?php

class Application_Resource_PianodiFuga extends Zend_Db_Table_Abstract
{
    protected $_name    = 'piano_di_fuga';
    protected $_primary  = 'Zona';
    protected $_rowClass = 'Application_Resource_PianodiFuga_Item';

	public function init()
    {
    }
    //estrae il piano di fuga relativo ad una zona e ad un piano. Se è stato inserito
    //dallo staff un percorso alternativo sarà visuallizato tale percorso altrimenti quello 
    //di default
    public function getEscapePlan($zone,$floor){
        
         $select = $this->select()
                        ->from(array('p' => 'piano_di_fuga'),
                         array('Piano_di_fuga', 'Piano_di_fuga_alternativo'))
                        ->where('Zona =?',$zone)
                        ->where('Id_piano =?',$floor);
        $result= $this->fetch($select);
        $escapeplan=$result['Piano_di_fuga'];
        if($result['Piano_di_fuga_alternativo']!=null){
            $escapeplan=$result['Piano_di_fuga_alternativo'];
        }
        
         return $escapeplan;   
            
    }
    
    
    //restituisce tutte le caratteristiche di quella zona
      public function getZone($zone,$floor){
        
         $select = $this->select()
                        ->where('Zona =?',$zone)
                        ->where('Id_piano =?',$floor);
                        
       return $this->fetch($select);
          
            
    }
    
    //settta il piano alternativo e se non è passato niente al parametro $plan lo setta a null
    public function setAlternativePlan($zone,$floor,$plan=null){
        $data=array('Piano_di_fuga_alternativo'=>$plan);
        $where[] = $table->getAdapter()->quoteInto('Zona = ?', $zone);
        $where[] = $table->getAdapter()->quoteInto('Id_piano = ?', $floor);
        $this->update($data,$where);
    }
    
    //inserisce una nuova zona con un nuovo piano di fuga
    public function insertNewZonePlan($zonedata){
         $this->insert($zonedata);
    }
   
   //elimina un percorso di fuga per zona
    public function deletePlanbyZone($zone)
    {
        $where = $table->getAdapter()->quoteInto('Zona = ?', $zone);
        $this->delete($where);
    }


    //elimina un percorso di fuga per piano
    public function deletePlanbyFloor($floor)
    {
        $where = $table->getAdapter()->quoteInto('Id_piano = ?', $floor);
        $this->delete($where);
    }
}

