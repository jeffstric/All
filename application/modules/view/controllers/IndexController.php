<?php

class View_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->view->hi = 'jeff';
    }

    public function viewTestAction()
    {
        // action body
        $data = array(
            array(
                'author' => 'Hernando de Soto',
                'title' => 'The Mystery of Capitalism'
            ),
            array(
                'author' => 'Henry Hazlitt',
                'title' => 'Economics in One Lesson'
            ),
            array(
                'author' => 'Milton Friedman',
                'title' => 'Free to Choose'
            )
        );
        
        Zend_Loader::loadClass('Zend_View');
        $view = new Zend_View();
        $view->books = $data;
        
        $view->addBasePath(APPLICATION_PATH.'/modules/view/views');
        
        echo $view->render('booklist.php');
    }

    public function smartyTestAction()
    {
        // action body
        $view = new Zend_View_Smarty(APPLICATION_PATH . '/modules/view/views/scripts/index/');
        
        $view->book = 'Zend PHP 5 Certification Study Guide';
        $view->author = 'Davey Shafik and Ben Ramsey';
        $rendered = $view->render('bookinfo.tpl');
        
        echo $rendered;
    }


}





