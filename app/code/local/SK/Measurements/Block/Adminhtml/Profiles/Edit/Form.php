<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 16.12.14
 * Time: 10:40
 */

class SK_Measurements_Block_Adminhtml_Profiles_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $helper = Mage::helper('sk_measurements');
        $profile = Mage::registry('current_profile');

        $form = new Varien_Data_Form(array(
            'id'     => 'edit_form',
            'action' => $this->getUrl('*/*/save', array(
                'id' => $this->getRequest()->getParam('id')
            )),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        if ($data = Mage::getSingleton('adminhtml/session')->getFormData()) {
            $form->setValues($data);
        } else {
            $form->setValues($profile->getData());
        }

        return parent::_prepareForm();
    }
}