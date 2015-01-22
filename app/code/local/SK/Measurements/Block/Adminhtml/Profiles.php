<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 05.12.14
 * Time: 15:08
 */

class SK_Measurements_Block_Adminhtml_Profiles extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('sk_measurements');
        $this->_blockGroup = 'sk_measurements';
        $this->_controller = 'adminhtml_profiles';

        $this->_headerText = $helper->__('Profiles Management');
        $this->_addButtonLabel = $helper->__('Add Profile');
    }

}