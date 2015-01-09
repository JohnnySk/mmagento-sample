<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 09.01.15
 * Time: 16:27
 */

class SK_Measurements_Block_Adminhtml_Profiles_Edit_Tab_Attributes extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setDataObject(Mage::registry('current_profile'));
        $fieldset = $form->addFieldset('info',
            array(
                'legend' => Mage::helper('sk_measurements')->__('Profile Information'),
                'class' => 'fieldset-wide',
            )
        );
        $attributes = $this->getAttributes();
        foreach ($attributes as $attribute) {
            $attribute->setEntity(Mage::getResourceModel('sk_measurements/profile'));
        }
        $this->_setFieldset($attributes, $fieldset, array());
        $formValues = Mage::registry('current_profile')->getData();
        $form->addValues($formValues);
        $form->setFieldNameSuffix('profile');
        $this->setForm($form);
    }

    protected function _prepareLayout()
    {
        Varien_Data_Form::setElementRenderer(
            $this->getLayout()->createBlock('adminhtml/widget_form_renderer_element')
        );
        Varien_Data_Form::setFieldsetRenderer(
            $this->getLayout()->createBlock('adminhtml/widget_form_renderer_fieldset')
        );
        Varien_Data_Form::setFieldsetElementRenderer(
            $this->getLayout()->createBlock('easylife_news/adminhtml_news_renderer_fieldset_element')
        );
    }

    /*protected function _getAdditionalElementTypes()
    {
        return array(
            'file' => Mage::getConfig()->getBlockClassName('easylife_news/adminhtml_article_helper_file'),
            'image' => Mage::getConfig()->getBlockClassName('easylife_news/adminhtml_article_helper_image'),
            'textarea' => Mage::getConfig()->getBlockClassName('adminhtml/catalog_helper_form_wysiwyg')
        );
    }*/

    public function getProfile()
    {
        return Mage::registry('current_profile');
    }
}