<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 13.01.15
 * Time: 16:16
 */

class SK_Measurements_Block_Adminhtml_Attribute_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array('id' => 'edit_form', 'action' => $this->getUrl('adminhtml/sk_measurements_profile_attribute/save'), 'method' => 'post'));
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}