<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 12.01.15
 * Time: 18:19
 */

class SK_Measurements_Block_Adminhtml_Attribute_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();

        $this->setId('profile_attribute_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('sk_measurements')->__('Attribute Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('main', array(
            'label' => Mage::helper('sk_measurements')->__('Properties'),
            'title' => Mage::helper('sk_measurements')->__('Properties'),
            'content' => $this->getLayout()->createBlock('sk_measurements/adminhtml_profile_attribute_edit_tab_main')->toHtml(),
            'active' => true
        ));
        $this->addTab('labels', array(
            'label' => Mage::helper('sk_measurements')->__('Manage Label / Options'),
            'title' => Mage::helper('sk_measurements')->__('Manage Label / Options'),
            'content' => $this->getLayout()->createBlock('sk_measurements/adminhtml_article_attribute_edit_tab_options')->toHtml(),
        ));
        return parent::_beforeToHtml();
    }
}