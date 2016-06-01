<?php

class Application_Resource_PianoImmobile_Item extends Zend_Db_Table_Row_Abstract
{       
    public function init()
    {
    }
    
    //serve per costruire il percorso dell'immagine della piantina.
    //Il path sarà il seguente:images/map/nome_immagine.jpg
    
    public function getMapPath($image){
        $pieces=array('images','map',$image);
        $pathimploded=implode('/', $pieces);
        return $pathimploded;
    }
}