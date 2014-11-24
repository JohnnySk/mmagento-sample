<?php

$installer = $this;

$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$entityTypeId = $setup->getEntityTypeId('customer');
$attributeSetId = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$setup->addAttribute('customer', 'balance', array(
    'input' => 'text',
    'type' => 'int',
    'label' => 'Balance',
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'adminhtml_only' => 1
));

$setup->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'balance',
    '999' //sort_order
);

$oAttribute = Mage::getSingleton('eav/config')->getAttribute('customer', 'balance');
$oAttribute->setData('used_in_forms', array('adminhtml_customer'));
$oAttribute->save();

$installer->run("
ALTER TABLE `{$installer->getTable('sales/quote_payment')}` ADD `check_no` VARCHAR( 255 ) NOT NULL ;
ALTER TABLE `{$installer->getTable('sales/quote_payment')}` ADD `check_date` VARCHAR( 255 ) NOT NULL ;

ALTER TABLE `{$installer->getTable('sales/order_payment')}` ADD `check_no` VARCHAR( 255 ) NOT NULL ;
ALTER TABLE `{$installer->getTable('sales/order_payment')}` ADD `check_date` VARCHAR( 255 ) NOT NULL ;
");
$installer->endSetup();

$setup->endSetup();
