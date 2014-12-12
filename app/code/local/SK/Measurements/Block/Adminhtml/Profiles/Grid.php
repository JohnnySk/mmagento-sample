<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 05.12.14
 * Time: 16:48
 */

class SK_Measurements_Block_Adminhtml_Profiles_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sk_measurements/profile')->getCollection();
        $collection->getSelect()->joinLeft(
            array('customer' => Mage::getConfig()->getTablePrefix().'customer_entity'),
            'e.customer_id = customer.entity_id',
            array(
                'email' => 'customer_email'
            )
        );

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }


    protected function _prepareColumns()
    {

        $helper = Mage::helper('sk_measurements');

        $this->addColumn('id', array(
            'header' => $helper->__('Profile ID'),
            'index' => 'entity_id'
        ));

        $this->addColumn('customer email', array(
            'header' => $helper->__('Customer Email'),
            'index' => 'customer_email',
            'type' => 'text',
        ));

        $this->addColumn('created_at', array(
            'header' => $helper->__('Created At'),
            'index' => 'created_at',
            'type' => 'text',
        ));

        $this->addColumn('updated_at', array(
            'header' => $helper->__('Updated At'),
            'index' => 'updated_at',
            'type' => 'text',
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('profiles');

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