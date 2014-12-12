<?php

class Web4pro_Buzz_Model_Resource_C_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('buzz/c');
    }
}