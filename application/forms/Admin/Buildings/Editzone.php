<?php
class Application_Form_Admin_Buildings_Editzone extends App_Form_Abstract
{
    protected $_adminModel;
        
    public function init(){
    }
     
    public function createForm($imm, $fl, $z = null){
            
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('zoneform');
        $this->setAction('');
       
        $this->addElement('file', 'escape_plan', array(
             'label' => $z == null ? 'Inserisci il piano di fuga di default' : 'Cambia il piano di fuga di default', 
             'destination' => '../public/images/escape_plan', 
             'required' => $z == null ? true : false,
             'validators' => array( array('Count', false, 1), 
                                    array('Size', false, 102400), 
                                    array('Extension', false, 
                                    array('jpg', 'gif')))
        ));
        
        $this->addElement('text', 'Shape', array(
            'label' => 'Forma della mappatura (tra " ")',
            'filters' => array('StringTrim'),
            'required' => true,
            'decorators' => $this->elementDecorators,
        ));
        $this->addElement('text', 'Coordinate', array(
            'label' => 'Coordinate della mappatura (tra " ")',
            'filters' => array('StringTrim'),
            'required' => true,
            'decorators' => $this->elementDecorators,
        ));
        
        $this->addElement('submit',$z == null ? 'aggiungi' : 'modifica', array(
            'label' => $z == null ? 'aggiungi' : 'modifica',
            'decorators' => $this->buttonDecorators,
        ));
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
        
        if($imm && $fl && $z){ 
            $values = $this->_adminModel->getEscapePlanInfo($z,$fl,$imm);
            
            $splitter = explode(' ', $values['Mappatura_zona']);
            $shape = explode('=', $splitter[0]);
            $coords = explode('=', $splitter[1]);
            
            $this->populate(array('Shape'      => $shape[1],
                                  'Coordinate' => $coords[1]));
        }
    } 
    
}