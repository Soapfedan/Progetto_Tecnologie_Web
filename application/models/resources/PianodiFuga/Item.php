<?php

class Application_Resource_PianodiFuga_Item extends Zend_Db_Table_Row_Abstract
{   
	public function init()
    {
    }
    
    //serve per costruire il percorso dell'immagine della via di fuga.
    //Il path sarà il seguente:immobile/piano/zona/nome_immagine.jpg
    public function getEscapePlanPath($path){
        $pathexploded=explode("/", $path);
        return array("immobile"=>$pathexploded[0], 
                     "piano"=>$pathexploded[1],
                     "zona"=>$pathexploded[2],
                     "piantina"=>$pathexploded[3]);
    }
    
}