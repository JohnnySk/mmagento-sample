<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 18.12.14
 * Time: 16:00
 */

class SK_Measurements_Block_Adminhtml_Profiles_Edit_Tab_Customers extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('profiles_customers_grid');
        $this->setDefaultSort('email', 'asc');
        $this->setSkipGenerateContent(true);
        $this->setUseAjax(true);
       /* if (Mage::registry('current_profile')) {
            $this->setDefaultFilter(array('attached_customer' => 1));
        }*/
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('customer/customer')->getCollection();
        $collection->getSelect()->joinLeft(
            array('customer_varchar' => Mage::getConfig()->getTablePrefix() . 'customer_entity_varchar'),
            'e.entity_id = customer_varchar.entity_id',
            array(
                'varchar_entity_id' => 'entity_id',
                'varchar_entity_type_id' => 'entity_type_id',
                'varchar_entity_value' => 'value'
            )
        );

        $collection->getSelect()->joinLeft(
            array('attribute' => Mage::getConfig()->getTablePrefix() . 'eav_attribute'),
            'customer_varchar.attribute_id = attribute.attribute_id',
            array(
                'eav_attribute_id' => 'attribute_id',
                'eav_entity_type_id' => 'entity_type_id',
            )
        )
            ->where("`attribute`.`attribute_code` = 'firstname'");

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    public function getCurrentProfile()
    {
        return Mage::registry('current_profile');
    }

    protected function _prepareColumns()
    {
        $this->addColumn('attached_customer', array(
            'header_css_class' => 'a-center',
            'type'             => 'radio',
            'name'             => 'attached_customer',
            'field_name'       => 'attached_customer',
            'disabled'         => false,
            'value'            => $this->getAttachedCustomer(),
            'align'            => 'center',
            'index'            => 'entity_id'
        ));

        $this->addColumn('email', array(
            'header'   => Mage::helper('sk_measurements')->__('Email'),
            'sortable' => true,
            'index'    => 'email'
        ));

        $this->addColumn('created_at', array(
            'header'   => Mage::helper('sk_measurements')->__('Created at'),
            'sortable' => true,
            'index'    => 'created_at'
        ));

        $this->addColumn('is_active', array(
            'header' => Mage::helper('sk_measurements')->__('is Active'),
            'index'  => 'is_active'
        ));

        $this->addColumn('customer_first_name', array(
            'header'   => Mage::helper('sk_measurements')->__('First Name'),
            'sortable' => true,
            'index'    => 'varchar_entity_value'
        ));

        return parent::_prepareColumns();
    }
    
    protected function _getAttachedCustomer()
    {
        $attachedCustomerId = $this->getCurrentProfile()->getCustomerId();

        return $attachedCustomerId;
    }

    protected function _addColumnFilterToCollection($column)
    {
        if ($column->getId() == "attached_customer") {

            $customerId = $this->_getAttachedCustomer();

            if (empty($customerId)) {
                $customerId = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', array('in' => $customerId));
            } elseif (!empty($customerId)) {
                $this->getCollection()->addFieldToFilter('entity_id', array('nin' => $customerId));
            }
        } else {

            parent::_addColumnFilterToCollection($column);
        }

        return $this;
    }
}