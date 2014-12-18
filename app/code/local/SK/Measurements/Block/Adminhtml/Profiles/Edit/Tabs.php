<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 18.12.14
 * Time: 15:43
 */

class SK_Measurements_Block_Adminhtml_Profiles_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('profile_info_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('sk_measurements')->__('Profile Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('customers', array(
            'label' => Mage::helper('sk_measurements')->__('Customers'),
            'class' => 'ajax',
            'url' => $this->getUrl('*/*/customers', array('_current' => true)),
        ));

        $this->_updateActiveTab();
        Varien_Profiler::stop('profile/tabs');
        return parent::_beforeToHtml();
    }

    protected function _updateActiveTab()
    {
        $tabId = $this->getRequest()->getParam('tab');
        if ($tabId) {
            $tabId = preg_replace("#{$this->getId()}_#", '', $tabId);
            if ($tabId) {
                $this->setActiveTab($tabId);
            }
        }
    }
}