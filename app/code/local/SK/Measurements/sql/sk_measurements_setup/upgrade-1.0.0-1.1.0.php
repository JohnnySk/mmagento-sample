<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 04.12.14
 * Time: 15:52
 */

/*@var $installer SK_Measurements_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$connection = $installer->getConnection();
$table = new Varien_Db_Ddl_Table();
$table->setName($this->getTable('sk_measurements/profile'));
$table->addColumn('customer_id',Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(), 'Customer Entity Id');
$table->addForeignKey('profile_customer_id', 'customer_id', $installer->getTable('customer/entity'), 'entity_id');

$installer->endSetup();