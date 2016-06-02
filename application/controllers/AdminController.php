<?php

class AdminController extends Zend_Controller_Action
{
    protected $_adminModel;
    
    protected $_edit;
    protected $_faqform;
    protected $_subform;
	protected $_insertfaqform;
    
    protected $_edituser;
    protected $_usersform;
    
    protected $_buildingsform;
       	
    public function init(){
        $this->_helper->layout->setLayout('arear');
        $this->_adminModel = new Application_Model_Admin();
        
        $this->_edit = $this->_getParam('edit');
        $this->_faqform = $this->getShowFaqForm($this->_edit == false ? false : true);
        $this->_subform = $this->_getParam('subform');
        
        $this->_edituser = $this->_getParam('edituser');
        $this->_usersform = $this->getShowUsersForm($this->_edituser == false ? false : true);
		
		$this->_insertfaqform = $this->getInsertFaqForm();
        $this->_buildingsform = $this->getShowBuildingsForm();
    }
    
    public function indexAction(){
    }
    public function welcomeAction(){
    }
	public function removeFaqAction(){
	}
    
    public function faqAction(){
        $this->view->msg='Gestisci le faq';
    }
    
    public function beforeinsertfaqAction(){
        $this->view ->msg ='insertfaq'; 
        $this->view->insertfaq = $this->_insertfaqform;       
    }
    
    public function insertfaqAction(){
		$values = $this->_insertfaqform->getValues();
            // Aggiungo un campo ID momentaneamente vuoto
		$values['ID'] = '';
        var_dump($values);
		$this->_adminModel->insertFaq($values);
    }
    
     /* Action chiamata quando si preme su Modifica Faq o Elimina Faq */
     public function showfaqAction(){
        $this->view->msg='Modifica/Cancella le faq'; 
        // Definisce le variabili per il viewer
        $this->view->assign(array('faqs' => $this->_faqform)); 
     }
    
    /* Action chiamata quando si preme il bottone relativo alla form di Modifica Faq */
    public function editfaqAction(){
        if($this->_edit==true){
            if (!$this->getRequest()->isPost()) {
                $this->_helper->redirector('faq','admin');
            }    
                                              
            if (!$this->getCurrentSubForm()->isValid($_POST)) {
                $this->getCurrentSubForm()->setDescription('Attenzione: alcuni dati inseriti sono errati.');
                return $this->render('showfaq');
            }
            
            $values = $this->getCurrentSubForm()->getValues();
            
            $result = array('ID'        => $values[$this->_subform]['ID'],
                            'Question'  => $values[$this->_subform]['Question'],
                            'Answer'    => $values[$this->_subform]['Answer']
                             );
            $this->_adminModel->modifyfaq($result);
            $this->render('welcome'); 
        }    
    }
    
    /* Action chiamata quando si preme il bottone relativo alla form di Elimina Faq */
    public function deletefaqAction(){
        if($this->_edit==false){
            $id=$this->_getParam('idfaq');
            $this->_adminModel->deleteFaq($id);
            $this->_helper->redirector('faq','admin');
        }   
    }
    
    public function getuserAction(){
        $this->view->msg='user'; 
    }
    
    public function insertuserAction(){     
    }
    
    public function showusersAction(){
        $this->view->assign(array('users' => $this->_usersform));      
    }
    
    /* Action chiamata quando si preme il bottone relativo alla form di Elimina Utenti */
    public function deleteuserAction(){
        if($this->_edituser==false){
            $user = $this->_getParam('usrid');
            $this->_adminModel->deleteUser($user);
            $this->_helper->redirector('getuser','admin');
        }   
    }
    
    public function immAction(){
        $this->view->msg='imm'; 
        $this->view->buildings = $this->_buildingsform; 
    }
    
    private function getLoginForm(){
        $urlHelper = $this->_helper->getHelper('url');
        $loginform = new Application_Form_Public_Auth_Login();
        $loginform->setAction($urlHelper->url(array(
                        'controller' => 'public',
                        'action'     => 'authenticate'
                        ), 
                        'default',true
                    ));
        return $loginform;
    }
    
    private function getShowFaqForm($edit){
        $this->_faqform = new Application_Form_Admin_Faq_Showfaq();
        $this->_faqform->createForm($edit);
        
        return $this->_faqform;
    }
  
    public function getCurrentSubForm(){        
        foreach (array_keys($this->_faqform->getSubForms()) as $name) {
            if ($data = $this->getRequest()->getPost($name, false)) {
                if (is_array($data)) {
                    return $this->_faqform->getSubForm($name);
                    break;
                }
            }
        }
        return false;
    } 
    
    public function getShowUsersForm($edit){
        $this->_f = new Application_Form_Admin_Users_Showusers();
        $this->_f->createForm($edit);
        return $this->_f;
    }
	
	private function getInsertFaqForm(){
	   $this->_form = new Application_Form_Admin_Faq_Insertfaq();
	   return $this->_form;
	}  
    
    private function getShowBuildingsForm(){
        $f = new Application_Form_Admin_Buildings_Showbuildings();
        $f->createForm();
        return $f;
    } 
 }