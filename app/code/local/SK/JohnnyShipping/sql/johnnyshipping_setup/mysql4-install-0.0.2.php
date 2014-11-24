<?php

$installer = $this;

$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$entityTypeId     = $setup->getEntityTypeId('customer_address');
$attributeSetId   = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$setup->addAttribute($entityTypeId, 'city_id', array(
    'input' => 'text',
    'type' => 'int',
    'label' => 'city_id',
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'adminhtml_only' => 0,
    'visible_on_front' => 1
));

$defaultUsedInForms = array(
    'customer_address_edit',
    'customer_register_address'
);

Mage::getSingleton('eav/config')
    ->getAttribute('customer_address', 'city_id')
    ->setData('used_in_forms', $defaultUsedInForms)
    ->save();

$setup->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'city_id'
);

$installer->endSetup();

$setup->endSetup();

