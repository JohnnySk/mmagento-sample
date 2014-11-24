<?php

class SK_JohnnyShipping_Model_Resource_District extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('johnnyshipping/district', 'id');
    }
}