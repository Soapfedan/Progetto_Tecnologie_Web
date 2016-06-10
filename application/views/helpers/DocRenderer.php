<?php
class Zend_View_Helper_DocRenderer extends Zend_View_Helper_HtmlElement
{
	private $_attrs;
	
	public function docRenderer($docFile)
	{
	 
		$tag = $this->view->baseUrl('relazione/' . $docFile);
		return $tag;
	}
  
}