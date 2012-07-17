<?php

class ZfTree_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    }
    
    public function getNodeAction()
    {
          $this->_helper->layout->disableLayout();
          
          $id = isset($_POST['id']) ? (int)$_POST['id'] : false;
          if(is_numeric($id) ){
              $this->view->categories = $this->getCategory($id);
          }else{
              die('id is illegal');
          }
    }

    private function getCategory($parentID = 0)
    {
        $db = $this->getDbCon();
        $select = $db   ->select()
                        ->from('category',array('CategoryID AS id','CategoryName AS name','ParentID AS pId'))
                        ->where('SiteID = ?',59)
                        ->where('parentID = ?',$parentID);
        $result = $db->fetchAll($select);
        foreach($result as $key=>$value){
            $result[$key]['isParent']=true;
        }
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



