<?php

class SK_JohnnyShipping_Block_Adminhtml_Johnnyshipping_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $helper = Mage::helper('johnnyshipping');
        $model = Mage::registry('current_tariff');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array(
                    'id' => $this->getRequest()->getParam('id')
                )),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $this->setForm($form);

        //get Cities
        $data = Mage::getModel('johnnyshipping/city');
        $collection = $data->getCollection();

        $fieldset = $form->addFieldset('tariff_form', array('legend' => $helper->__('Tariff Information')));

        $fieldset->addField('weight_from', 'text', array(
            'label' => $helper->__('Weight From'),
            'required' => true,
            'name' => 'weight_from',
        ));

        $fieldset->addField('weight_to', 'text', array(
            'label' => $helper->__('Weight To'),
            'required' => true,
            'name' => 'weight_to',
        ));

        $fieldset->addField('tariff', 'text', array(
            'label' => $helper->__('Tariff'),
            'required' => true,
            'name' => 'tariff'
        ));

        $fieldset->addField('tariff_plus', 'text', array(
            'label' => $helper->__('Tariff Plus'),
            'required' => false,
            'name' => 'tariff_plus'
        ));

        $fieldset->addField('city_id', 'select', array(
            'label' => $helper->__('City Id'),
            'required' => true,
            'name' => 'city_id',
            'values' => $collection->toOptionArray()
        ));

        $form->setUseContainer(true);

        if ($data = Mage::getSingleton('adminhtml/session')->getFormData()) {
            $form->setValues($data);
        } else {
            $form->setValues($model->getData());
        }

        return parent::_prepareForm();
    }

}