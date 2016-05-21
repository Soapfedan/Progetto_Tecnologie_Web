<?php

class Application_Resource_PianodiFuga_Item extends Zend_Db_Table_Row_Abstract
{   
	public function init()
    {
    }
    
  //serve per costruire il percorso dell'immagine della via di fuga.
    //Il path sarà il seguente:immobile/piano/zona/nome_immagine.jpg
    public function getEscapePlanPath($imm,$floor,$zone,$image){
        $pieces=array($imm,$floor,$zone,$image);
        $pathimploded=implode('/', $pieces);
        return $pathimploded;
    }
    
}