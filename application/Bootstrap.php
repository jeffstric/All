<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initDb()
    {
        $config = new Zend_Config_Ini(
                  APPLICATION_PATH . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'db.ini' ,
                $_SERVER["APPLICATION_ENV"]);
        $dbConfig = $config->database->toArray();
        $db = Zend_db::factory($dbConfig['adapter'], $dbConfig['params']);
        Zend_Registry::set('db', $db);
        Zend_Db_Table::setDefaultAdapter($db);
    }
    
    protected function _initPlaceHolder()
    {
        
        $this->bootstrap('view');
        $view = $this->getResource('view');
                            
        $view->doctype()->doctype('XHTML1_STRICT');
        
        $view->headTitle('ZF学习案例');
        
        $view->headMeta()   ->appendName('keywords', 'framework php example')
                            ->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8')
                            //->appendHttpEquiv('expires', '90');//可以用于设定网页的到期时间。一旦网页过期，必须到服务器上重新传输。 
                            ->appendHttpEquiv('pragma', 'no-cache')//禁止从本地缓存中读取
                            ->appendHttpEquiv('Cache-Control', 'no-cache');//访问这个网站需要重新下载
        
        $view->headScript() ->appendFile('/javascript/common.js')//插入末尾
                            ->prependFile('/javascript/jquery.min.js');//插入开头
        
        $view->headLink()->appendStylesheet('/styles/default.css');
        
        
    }
}

