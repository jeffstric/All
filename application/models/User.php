<?php

class Application_Model_User extends Zend_Db_Table
{
    protected $_name = 'user';
    protected $_primary  = 'user_id';
    
//    public function namePwCheck($name,$pw)
//    {
//        $select = $this ->select()
//                        ->from($this->_name)
//                        ->where('user_name = ?',$name);
//        $result = $this->fetchRow($select)->toArray();
//        
//        if(isset($result) ){
//            if($result['user_pw'] == $pw){
//                return $result['user_id'];
//            }
//        }
//        
//        return false;
//    }
    public function getUserName($user_id)
    {
        $select = $this ->select()
                        ->from($this->_name,array('user_name'))
                        ->where('user_id = ?',$user_id);
        $result = $this->fetchRow($select)->toArray();
        
        if(isset($result) ){
            return $result['user_name'];
        }
        
        return false;
    }

}

