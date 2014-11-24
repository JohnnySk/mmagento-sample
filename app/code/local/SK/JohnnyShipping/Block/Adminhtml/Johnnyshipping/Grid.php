<?php

class SK_JohnnyShipping_Block_Adminhtml_Johnnyshipping_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('johnnyshipping/tariff')->getCollection();
        $collection->getSelect()->joinLeft(
            array('city' => Mage::getConfig()->getTablePrefix().'johnnyshipping_city'),
            'main_table.city_id = city.id',
            array(
                'city_name' => 'name',
                'region_id' => 'region'
            )
        );

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $helper = Mage::helper('johnnyshipping');

        $this->addColumn('id', array(
            'header' => $helper->__('Tariff ID'),
            'index' => 'id'
        ));

        $this->addColumn('weight_from', array(
            'header' => $helper->__('Weight From'),
            'index' => 'weight_from',
            'type' => 'text',
        ));

        $this->addColumn('weight_to', array(
            'header' => $helper->__('Weight To'),
            'index' => 'weight_to',
            'type' => 'text',
        ));

        $this->addColumn('tariff', array(
            'header' => $helper->__('Tariff'),
            'index' => 'tariff',
            'type' => 'text',
        ));

        $this->addColumn('tariff_plus', array(
            'header' => $helper->__('Tariff Plus'),
            'index' => 'tariff_plus',
            'type' => 'text',
        ));

        $this->addColumn('city name', array(
            'header' => $helper->__('City'),
            'index' => 'city_name',
            'type' => 'text',
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('tariffs');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
        ));
        return $this;
    }

    public function getRowUrl($model)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $model->getId(),
        ));
    }
}