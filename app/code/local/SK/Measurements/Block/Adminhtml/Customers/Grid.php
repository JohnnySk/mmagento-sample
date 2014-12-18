<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 16.12.14
 * Time: 15:31
 */

class SK_Measurements_Block_Adminhtml_Customers_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('customer/customer')->getCollection();
        $collection->getSelect()->joinLeft(
            array('customer_varchar' => Mage::getConfig()->getTablePrefix() . 'customer_entity_varchar'),
            'e.entity_id = customer_varchar.entity_id',
            array(
                'email' => 'email',
                'varchar_entity_id' => 'entity_id',
                'varchar_entity_type_id' => 'entity_type_id'
            )
        );

        $collection->getSelect()->joinLeft(
            array('attribute' => Mage::getConfig()->getTablePrefix() . 'eav_attribute'),
            'customer_varchar.attribute_id = attribute.attribute_id',
            array(
                'eav_attribute_id' => 'attribute_id',
                'eav_entity_type_id' => 'entity_type_id',
            )
        );

        $collection->getSellect()->__toString();

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
}