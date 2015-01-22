<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 12.01.15
 * Time: 17:48
 */

class SK_Measurements_Block_Adminhtml_Attribute_Grid extends Mage_Eav_Block_Adminhtml_Attribute_Grid_Abstract
{
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('sk_measurements/profile_attribute_collection')
            ->addVisibleFilter();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        parent::_prepareColumns();
        $this->addColumnAfter('is_global', array(
            'header' => Mage::helper('sk_measurements')->__('Scope'),
            'sortable' => true,
            'index' => 'is_global',
            'type' => 'options',
            'options' => array(
                Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE => Mage::helper('sk_measurements')->__('Store View'),
                Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE => Mage::helper('sk_measurements')->__('Website'),
                Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL => Mage::helper('sk_measurements')->__('Global'),
            ),
            'align' => 'center',
        ), 'is_user_defined');
        return $this;
    }
}