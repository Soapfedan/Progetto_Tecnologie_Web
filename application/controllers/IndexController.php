<?php

class IndexController extends Zend_Controller_Action
{	
    public function init()
    {
    }
    public function indexAction()
    {
                echo 1;

		$this->_helper->redirector('index','public');
    }
 }