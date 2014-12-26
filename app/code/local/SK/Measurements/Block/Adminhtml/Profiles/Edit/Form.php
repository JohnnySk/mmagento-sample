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

        //create form elements for profile
        $fieldset = $form->addFieldset('profile_form', array('legend' => $helper->__('Tariff Information')));

        $fieldset->addField('weight', 'text', array(
            'label' => $helper->__('Weight'),
            'required' => true,
            'name' => 'weight',
        ));

        $fieldset->addField('height', 'text', array(
            'label'    => $helper->__('Height'),
            'required' => true,
            'name'     => 'height'
        ));

        $fieldset->addField('age', 'text', array(
            'label'    => $helper->__('Age'),
            'required' => true,
            'name'     => 'age'
        ));

        $fieldset->addField('press', 'text', array(
            'label'    => $helper->__('Press'),
            'required' => true,
            'name'     => 'press'
        ));

        $fieldset->addField('deadlift', 'text', array(
            'label'    => $helper->__('Deadlift'),
            'required' => true,
            'name'     => 'deadlift'
        ));

        $fieldset->addField('squat', 'text', array(
            'label'    => $helper->__('Squat'),
            'required' => true,
            'name'     => 'Squat'
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