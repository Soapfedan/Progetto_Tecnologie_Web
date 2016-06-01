<?php
class Zend_View_Helper_ImgRenderer extends Zend_View_Helper_HtmlElement
{
	private $_attrs;
	
	public function imgRenderer($imgFile, $attrs = false)
	{
	    
		if (null !== $attrs) {
			$_attrs = $this->_htmlAttribs($attrs);
		} else {
			$_attrs = '';
		}
		$tag = '<img src="' . $this->view->baseUrl('images/' . $imgFile) . '" ' . $_attrs . '>';
		return $tag;
	}
  
}