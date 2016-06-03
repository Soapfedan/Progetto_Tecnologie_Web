<?php
class Zend_View_Helper_PrintArea extends Zend_View_Helper_HtmlElement
{
	

    
    public function printArea($schema,$imm,$floor,$controller)
    {
        if($controller=='user'){
            $tag='';
            foreach ($schema as $element) {
               $tag .= ' <area ' .$element->Mappatura_zona . 'href = "'. $this->view->url(array(
                            'controller' => 'user',
                            'action'     => 'setposition',
                            'zone'       => $element->Zona,
                            'immobile'   => $imm,
                            'floor'      => $floor
                            
                            ), 
                            'default',true
                        )  . '" > ';
            } 
            $tag .='</map>';
            return $tag;
        }else if($controller=='public'){
           $tag='';
            foreach ($schema as $element) {
               $tag .= ' <area ' .$element->Mappatura_zona . 'href = "'. $this->view->url(array(
                            'controller' => 'public',
                            'action'     => 'setposition',
                            'zone'       => $element->Zona,
                            'immobile'   => $imm,
                            'floor'      => $floor
                            
                            ), 
                            'default',true
                        )  . '" > ';
            } 
            $tag .='</map>';
            return $tag; 
        }
    }
}