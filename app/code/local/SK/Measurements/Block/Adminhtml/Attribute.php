<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 09.01.15
 * Time: 17:19
 */

class SK_Measurements_Block_Adminhtml_Attribute extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_profiles';
        $this->_blockGroup = 'sk_measurements';
        $this->_headerText = Mage::helper('sk_measurements')->__('Manage Profiles Attributes');
        parent::__construct();
        $this->_updateButton('add', 'label', Mage::helper('sk_measurements')->__('Add New Profile Attribute'));
    }
}