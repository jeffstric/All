<?php

class Auth_IndexController extends Zend_Controller_Action
{
    private $userM;
    private $userName;

    public function init()
    {
        $this->checkLogin();
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        
    }
    
    private function checkLogin()
    {   
        $this->userM = new Application_Model_User();
        $loginS = new Zend_Session_Namespace('login');
        $this->userName = $this->userM->getUserName($loginS->id);
        
        if( !$this->userName){
            $this->_redirect('auth/login');
        }
        
    }


}

