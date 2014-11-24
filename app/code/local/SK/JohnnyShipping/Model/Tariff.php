<?php

class SK_JohnnyShipping_Model_Tariff extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('johnnyshipping/tariff');
    }
}