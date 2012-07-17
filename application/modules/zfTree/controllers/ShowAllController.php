<?php

class ZfTree_ShowAllController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->view->categories = $this->getCategory();
    }
    
    private function getCategory()
    {
        $db = $this->getDbCon();
        $select = $db   ->select()
                        ->from('category',array('CategoryID AS id','CategoryName AS name','ParentID AS pId'))
                        ->where('SiteID = ?',59);
        $result = $db->fetchAll($select);
        return $result;
    }

    private function getDbCon()
    {

        $params = array ('host'    => '127.0.0.1',
                        'username' => 'root',
                        'password' => '2126823',
                        'dbname'   => 'thearchy');

        $db = Zend_Db::factory('PDO_MYSQL', $params);
        $db->query('set names utf8');
        
        return $db;
    }


}

