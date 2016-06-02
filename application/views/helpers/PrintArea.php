<?php
class Zend_View_Helper_PrintArea extends Zend_View_Helper_HtmlElement
{
	

    
    public function printArea($schema)
    {
        $tag='';
       foreach ($schema as $element) {
           $tag .= ' <area ' .$element->Mappatura_zona . 'href = "'. $this->view->url(array(
                        'controller' => 'user',
                        'action'     => 'setpositon',
                        'zone'       => $element->Zona
                        ), 
                        'default',true
                    )  . '" > ';
       } 
        $tag .='</map>';
        return $tag;
    }
}