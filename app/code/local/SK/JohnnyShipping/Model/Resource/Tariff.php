<?php

class SK_JohnnyShipping_Model_Resource_Tariff extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('johnnyshipping/tariff', 'id');
    }
}