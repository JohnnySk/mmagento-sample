<?php

class Web4pro_Buzz_Model_Resource_A extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('buzz/a', 'id');
    }
}