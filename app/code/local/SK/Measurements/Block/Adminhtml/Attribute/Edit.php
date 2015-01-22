<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 12.01.15
 * Time: 17:58
 */

class SK_Measurements_Block_Adminhtml_Attribute_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'attribute_id';
        $this->_controller = 'adminhtml_profiles_attribute';
        $this->_blockGroup = 'sk_measurements';

        parent::__construct();
        $this->_addButton(
            'save_and_edit_button',
            array(
                'label' => Mage::helper('sk_measurements')->__('Save and Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class' => 'save'
            ),
            100
        );
        $this->_updateButton('save', 'label', Mage::helper('sk_measurements')->__('Save Profile Attribute'));
        $this->_updateButton('save', 'onclick', 'saveAttribute()');

        if (!Mage::registry('entity_attribute')->getIsUserDefined()) {
            $this->_removeButton('delete');
        } else {
            $this->_updateButton('delete', 'label', Mage::helper('sk_measurements')->__('Delete Profile Attribute'));
        }
    }

    public function getHeaderText()
    {
        if (Mage::registry('entity_attribute')->getId()) {
            $frontendLabel = Mage::registry('entity_attribute')->getFrontendLabel();
            if (is_array($frontendLabel)) {
                $frontendLabel = $frontendLabel[0];
            }
            return Mage::helper('sk_measurements')->__('Edit Profile Attribute "%s"', $this->htmlEscape($frontendLabel));
        } else {
            return Mage::helper('sk_news')->__('New Profile Attribute');
        }
    }

    public function getValidationUrl()
    {
        return $this->getUrl('*/*/validate', array('_current' => true));
    }

    public function getSaveUrl()
    {
        return $this->getUrl('*/' . $this->_controller . '/save', array('_current' => true, 'back' => null));
    }
}