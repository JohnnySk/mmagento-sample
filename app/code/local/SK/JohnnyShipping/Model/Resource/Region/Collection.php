<?php

class SK_JohnnyShipping_Model_Resource_Region_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _consrtuct()
    {
        $this->_init('johnnyshipping/region');
    }
}