<?php

class Auth_LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $form = $this->getForm();
        if ( $this->getRequest()->isPost() ) {
            if ( $form->isValid($_POST) ) {
                //利用Zend_Auth
                $info = '';
                $resultCheck = $this->checkNamePw($_POST['username'],$_POST['password'],$info);
                if( $resultCheck ){
                    $this->setSession($resultCheck);
                    $this->_redirect('auth/index');
                }else{
                    $form->addErrorMessage($info);
                }
            }
        }
        $this->view->form = $form;
    }

    private function getForm()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/form.ini', 'authLogin');
        $form = new Zend_Form($config);
        return $form;
    }

    private function checkNamePw( $name, $pw , &$info = '' )
    {
        $dbAdapter = Zend_Registry::get('db');
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter, 'user', 'user_name', 'user_pw');
        $authAdapter->setIdentity($name)
                    ->setCredential($pw);

        $result = $authAdapter->authenticate();
        $info = array_shift($result->getMessages());
        
        if($result->isValid()){
            $resultDB = $authAdapter->getResultRowObject();
            return $resultDB->user_id;
        }else{
            return FALSE;
        }
    }

    private function setSession($userId)
    {
        $loginS = new Zend_Session_Namespace('login');
        $loginS->loginTime = time();
        $loginS->id = $userId;
    }

}

