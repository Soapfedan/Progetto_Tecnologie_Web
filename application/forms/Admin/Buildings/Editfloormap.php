<?php
class Application_Form_Admin_Buildings_Editfloormap extends App_Form_Abstract
{
    protected $_adminModel;
        
    public function init(){
    }
     
    public function createForm($imm, $fl = null){
            
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('floorform');
        $this->setAction('');
         
        $this->addElement('file', 'map', array(
             'label' => $fl == null ? 'Inserisci la mappa del piano' : 'Cambia la mappa del piano', 
             'destination' => '../public/images/map', 
             'required'  => $fl == null ? true : false, 
             'validators' => array( array('Count', false, 1), 
                                    array('Size', false, 102400), 
                                    array('Extension', false, 
                                    array('jpg', 'gif')))
        ));
        
        $this->addElement('submit',$fl == null ? 'aggiungi' : 'modifica', array(
            'label' => $fl == null ? 'aggiungi' : 'modifica',
            'decorators' => $this->buttonDecorators,
        ));

    } 
    
}