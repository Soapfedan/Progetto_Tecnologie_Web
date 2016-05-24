<?php
class Zend_View_Helper_ImgRenderer extends Zend_View_Helper_Abstract
{
	private $_attrs;
	
	public function imgRenderer($imgFile, $attrs = false)
	{
	    /*
		if (empty($imgFile)) {
			$imgFile = 'default.jpg';
		}*/
		if (null !== $attrs) {
			$_attrs = $this->_htmlAttribs($attrs);
		} else {
			$_attrs = '';
		}
		$tag = '<img src="' . $this->view->baseUrl('images/' . $imgFile) . '" ' . $_attrs . '>';
		return $tag;
	}
}