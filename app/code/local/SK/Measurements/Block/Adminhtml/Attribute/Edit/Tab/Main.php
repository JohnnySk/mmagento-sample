<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 13.01.15
 * Time: 16:26
 */

class SK_Measurements_Block_Adminhtml_Attribute_Edit_Tab_Main extends Mage_Eav_Block_Adminhtml_Attribute_Edit_Main_Abstract
{
    protected function _prepareForm()
    {
        parent::_prepareForm();
        $attributeObject = $this->getAttributeObject();
        $form = $this->getForm();
        $fieldset = $form->getElement('base_fieldset');
        $frontendInputElm = $form->getElement('frontend_input');
        /*$additionalTypes = array(
            array(
                'value' => 'image',
                'label' => Mage::helper('sk_measurements')->__('Image')
            ),
            array(
                'value' => 'file',
                'label' => Mage::helper('easylife_news')->__('File')
            )
        );*/
        $response = new Varien_Object();
        $response->setTypes(array());
        Mage::dispatchEvent('adminhtml_article_attribute_types', array('response' => $response));
        $_disabledTypes = array();
        $_hiddenFields = array();
        foreach ($response->getTypes() as $type) {
            $additionalTypes[] = $type;
            if (isset($type['hide_fields'])) {
                $_hiddenFields[$type['value']] = $type['hide_fields'];
            }
            if (isset($type['disabled_types'])) {
                $_disabledTypes[$type['value']] = $type['disabled_types'];
            }
        }
        Mage::register('attribute_type_hidden_fields', $_hiddenFields);
        Mage::register('attribute_type_disabled_types', $_disabledTypes);

        $frontendInputValues = array_merge($frontendInputElm->getValues(), $additionalTypes);
        $frontendInputElm->setValues($frontendInputValues);

        $yesnoSource = Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray();

        $scopes = array(
            Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE => Mage::helper('sk_measurements')->__('Store View'),
            Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE => Mage::helper('sk_measurements')->__('Website'),
            Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL => Mage::helper('sk_measurements')->__('Global'),
        );

        $fieldset->addField('is_global', 'select', array(
            'name' => 'is_global',
            'label' => Mage::helper('easylife_news')->__('Scope'),
            'title' => Mage::helper('easylife_news')->__('Scope'),
            'note' => Mage::helper('easylife_news')->__('Declare attribute value saving scope'),
            'values' => $scopes
        ), 'attribute_code');
        $fieldset->addField('position', 'text', array(
            'name' => 'position',
            'label' => Mage::helper('sk_measurements')->__('Position'),
            'title' => Mage::helper('sk_measurements')->__('Position'),
            'note' => Mage::helper('sk_measurements')->__('Position in the admin form'),
        ), 'is_global');
        $fieldset->addField('note', 'textarea', array(
            'name' => 'note',
            'label' => Mage::helper('sk_measurements')->__('Note'),
            'title' => Mage::helper('sk_measurements')->__('Note'),
            'note' => Mage::helper('sk_measurements')->__('Text to appear below the input.'),
        ), 'position');

        $fieldset->removeField('default_value_text');
        $fieldset->removeField('default_value_yesno');
        $fieldset->removeField('default_value_date');
        $fieldset->removeField('default_value_textarea');
        $fieldset->removeField('is_unique');
        // frontend properties fieldset
        $fieldset = $form->addFieldset('front_fieldset', array('legend' => Mage::helper('sk_measurements')->__('Frontend Properties')));


        $fieldset->addField('is_wysiwyg_enabled', 'select', array(
            'name' => 'is_wysiwyg_enabled',
            'label' => Mage::helper('sk_measurements')->__('Enable WYSIWYG'),
            'title' => Mage::helper('sk_measurements')->__('Enable WYSIWYG'),
            'values' => $yesnoSource,
        ));
        Mage::dispatchEvent('sk_measurements_adminhtml_profile_attribute_edit_prepare_form', array(
            'form' => $form,
            'attribute' => $attributeObject
        ));
        return $this;
    }
}