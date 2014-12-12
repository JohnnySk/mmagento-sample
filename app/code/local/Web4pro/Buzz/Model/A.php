<?php

class Web4pro_Buzz_Model_A extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('buzz/a');
    }
}