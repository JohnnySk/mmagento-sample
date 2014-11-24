<?php

class SK_JohnnyShipping_Block_Adminhtml_Johnnyshipping_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init class
     */
    public function __construct()
    {
        $this->_blockGroup = 'johnnyshipping';
        $this->_controller = 'adminhtml_johnnyshipping';

        parent::__construct();

       // $this->_updateButton('save', 'label', $this->__('Save Tariff'));
        //$this->_updateButton('delete', 'label', $this->__('Delete Tariff'));
    }

    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        $helper = Mage::helper('johnnyshipping');
        $model = Mage::registry('current_tariff');
        if ($model->getId()) {
            return $helper->__('Edit Tariff %s', $this->escapeHtml($model->getId()));
        } else {
            return $helper->__('New Tariff');
        }
    }
}