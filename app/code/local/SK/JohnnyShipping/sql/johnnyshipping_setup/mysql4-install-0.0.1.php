<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/**
 * Create table 'johnnyshipping_city'
 */
$table = $installer->getConnection()

    ->newTable($installer->getTable('johnnyshipping/city'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 0, array(
        'nullable' => false,
    ), 'Name');
$installer->getConnection()->createTable($table);


/**
 * Create table 'johnnyshipping_region'
 */
$table = $installer->getConnection()

    ->newTable($installer->getTable('johnnyshipping/region'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 0, array(
        'nullable' => false,
    ), 'Name')
    ->addColumn('city_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
        'nullable' => true
    ), 'City Id')
    ->addForeignKey('region_city_id', 'city_id', $installer->getTable('johnnyshipping/city'), 'id');
$installer->getConnection()->createTable($table);

/**
 * Create table 'johnnyshipping_district'
 */
$table = $installer->getConnection()

    ->newTable($installer->getTable('johnnyshipping/district'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 0, array(
        'nullable' => false,
    ), 'Name')
    ->addColumn('reg_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
        'nullable' => true,
    ), 'Region Id')
    ->addColumn('city_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
        'nullable' => true,
    ), 'City Id')
    ->addForeignKey('district_reg_id', 'reg_id', $installer->getTable('johnnyshipping/region'), 'id')
    ->addForeignKey('district_city_id', 'city_id', $installer->getTable('johnnyshipping/city'), 'id');
$installer->getConnection()->createTable($table);

/**
 * Create table 'johnnyshipping_tariff'
 */
$table = $installer->getConnection()

    ->newTable($installer->getTable('johnnyshipping/tariff'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'ID')
    ->addColumn('weight_from', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
        'nullable' => false,
    ), 'Weight From')
    ->addColumn('weight_to', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
        'nullable' => true,
    ), 'Weight To')
    ->addColumn('tariff', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
        'nullable' => false,
    ), 'Tariff')
    ->addColumn('tariff_plus', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
        'nullable' => true,
    ), 'Tariff')
    ->addColumn('city_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 0, array(
        'nullable' => true
    ), 'City Id')
    ->addForeignKey('tariff_city_id', 'city_id', $installer->getTable('johnnyshipping/city'), 'id');
$installer->getConnection()->createTable($table);

$installer->endSetup();