<?php
class Zend_View_Helper_MapRenderer extends Zend_View_Helper_HtmlElement
{
	private $_attrs;
	
	
    //va a creare il tag html dell'immagine con gli eventuali attributi (attrs) e con il riferimento alla <map>
    
    public function mapRenderer($map, $attrs = false)
    {
        //va a separare il nome della mappa dalla sua estensione mapname[0] sarà il nome mapname[1] sara' l'estensione
        $mapname = explode('.',$map->Mappa);
        if (null !== $attrs) {
            $_attrs = $this->_htmlAttribs($attrs);
        } else {
            $_attrs = '';
        }
        $tag = '<img src="' . $this->view->baseUrl($map->getMapPath($map->Mappa)) . '" ' . $_attrs . 'usemap = " #'.
        $mapname[0] .'"' . '>';
        $tag .=' <map name="'.$mapname[0].'">';
        return $tag;
    }
   
}