<?php

class Web4pro_Buzz_Model_C extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('buzz/c');
    }
}