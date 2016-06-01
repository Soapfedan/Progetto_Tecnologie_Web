<?php
class Zend_View_Helper_MapRenderer extends Zend_View_Helper_HtmlElement
{
	private $_attrs;
	
	
    
    public function mapRenderer($map, $attrs = false)
    {
        
        if (null !== $attrs) {
            $_attrs = $this->_htmlAttribs($attrs);
        } else {
            $_attrs = '';
        }
        $tag = '<img src="' . $this->view->baseUrl($map->getMapPath($map->Mappa)) . '" ' . $_attrs . '>';
        return $tag;
    }
   
}