<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 16.12.14
 * Time: 10:39
 */

class SK_Measurements_Block_Adminhtml_Profiles_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    /**
     * Init Class
     */
    public function __construct()
    {
        $this->_blockGroup = 'sk_measurements';
        $this->_controller = 'adminhtml_profiles';

        parent::__construct();
    }

    /**
     * Get Header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        $helper = Mage::helper('sk_measurements');
        $model = Mage::registry('current_profile');
        if ($model->getId()) {
            return $helper->__('Edit Profile %s', $this->escapeHtml($model->getId()));
        } else {
            return $helper->__('New Profile');
        }
    }
}