<?php

class SK_JohnnyShipping_Model_Resource_District_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('johnnyshipping/district');
    }
}