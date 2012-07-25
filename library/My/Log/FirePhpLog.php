<?php

    class My_Log_FirePhpLog extends Zend_Log
    {
        private $_enable = false;
        
        public function getEnable()
        {
            return $this->_enable;
        }

        public function setEnable($_enable)
        {
            $this->_enable = (boolean)$_enable;
            return $this;
        }

        public function toggleEnable( )
        {
            $this->_enable = ( $this->_enable == false );
            return $this;
        }

                
        public function __construct()
        {
            $writer = new Zend_Log_Writer_Firebug();
            parent::__construct($writer);
        }
        
        public function log($message, $priority = Zend_Log::INFO, $extras = null)
        {
            if($this->getEnable()){
                parent::log($message, $priority, $extras = null);
            }
            return $this;
        }
        
        public function log_once($message, $priority = Zend_Log::INFO, $extras = null)
        {
            $this   ->setEnable(true)
                    ->log($message, $priority, $extras)
                    ->setEnable(false);
            
            return $this;
        }
    }
?>
