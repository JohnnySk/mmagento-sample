<?php

class SK_JohnnyShipping_Block_Adminhtml_Johnnyshipping extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('johnnyshipping');
        $this->_blockGroup = 'johnnyshipping';
        $this->_controller = 'adminhtml_johnnyshipping';

        $this->_headerText = $helper->__('Tariff Management');
        $this->_addButtonLabel = $helper->__('Add Tariff');
    }
}