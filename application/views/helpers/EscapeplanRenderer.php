<?php
class Zend_View_Helper_EscapeplanRenderer extends Zend_View_Helper_HtmlElement
{
	private $_attrs;

    
    public function escapePlanRenderer($plan, $attrs = false)
    {
        
        if (null !== $attrs) {
            $_attrs = $this->_htmlAttribs($attrs);
        } else {
            $_attrs = '';
        }
        if($plan->Piano_di_fuga!=null){
            $tag = '<img src="' . $this->view->baseUrl($plan->getEscapePlanPath($plan->Piano_di_fuga)) . '" ' . $_attrs . '>';
        }else{
            $tag = '<img src="' . $this->view->baseUrl($plan->getEscapePlanPath($plan->Piano_di_fuga_alternativo)) . '" ' . $_attrs . '>';
        }
        
        return $tag;
    }
}