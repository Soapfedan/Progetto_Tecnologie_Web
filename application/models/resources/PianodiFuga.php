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
   

}

