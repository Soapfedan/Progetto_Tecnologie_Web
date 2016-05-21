<?php
class Application_Form_Admin_Product_Add extends Zend_Form
{
	protected $_adminModel;

	public function init()
	{
		//$this->_adminModel = new Application_Model_Admin();
		$this->setMethod('post');
		$this->setName('addproduct');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');

		$this->addElement('text', 'name', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
        		'description' => 'testo di descrizione',
            'validators' => array(array('StringLength',true, array(1,25))),
		));

	
		$this->addElement('submit', 'add', array(
            'label' => 'Accedi',
		));
	}
}