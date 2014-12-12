<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 03.12.14
 * Time: 16:33
 */

/*@var $installer SK_Measurements_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
/* Create table 'sk_phonebook/profile' */
$table = $installer->getConnection()
    ->newTable($installer->getTable('sk_measurements/profile'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Entity ID')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(), 'Creation Time')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(), 'Update Time')
    ->setComment('Sk Measurements Profile Table');
$installer->getConnection()->createTable($table);
/* Create table 'sk_measurements/profile_entity_varchar' */
$table = $installer->getConnection()
    ->newTable($installer->getTable('sk_measurements/profile_entity_varchar'))
    ->addColumn('value_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Value Id')
    ->addColumn('entity_type_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Entity Type Id')
    ->addColumn('attribute_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Attribute Id')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Store ID')
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Entity Id')
    ->addColumn('value', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Value')
    ->addIndex(
        $installer->getIdxName(
            'sk_measurements_profile_entity_varchar',
            array('entity_id', 'attribute_id', 'store_id'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
        ),
        array('entity_id', 'attribute_id', 'store_id'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE))
    ->addIndex($installer->getIdxName('sk_measurements_profile_entity_varchar', array('attribute_id')),
        array('attribute_id'))
    ->addIndex($installer->getIdxName('sk_measurements_profile_entity_varchar', array('store_id')),
        array('store_id'))
    ->addIndex($installer->getIdxName('sk_measurements_profile_entity_varchar', array('entity_id')),
        array('entity_id'))
    ->addForeignKey(
        $installer->getFkName('sk_measurements_profile_entity_varchar', 'attribute_id', 'eav/attribute', 'attribute_id'),
        'attribute_id', $installer->getTable('eav/attribute'), 'attribute_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey(
        $installer->getFkName('sk_measurements_profile_entity_varchar', 'entity_id', 'sk_measurements/profile', 'entity_id'),
        'entity_id', $installer->getTable('sk_measurements/profile'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey(
        $installer->getFkName('sk_measurements_profile_entity_varchar', 'store_id', 'core/store', 'store_id'),
        'store_id', $installer->getTable('core/store'), 'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Sk Measurements Profile Entity Varchar');
$installer->getConnection()->createTable($table);
/* Create table 'sk_measurements/profile_entity_int' */
$table = $installer->getConnection()
    ->newTable($installer->getTable('sk_measurements/profile_entity_int'))
    ->addColumn('value_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Value Id')
    ->addColumn('entity_type_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Entity Type Id')
    ->addColumn('attribute_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Attribute Id')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Store ID')
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Entity Id')
    ->addColumn('value', Varien_Db_Ddl_Table::TYPE_INTEGER, 255, array(), 'Value')
    ->addIndex(
        $installer->getIdxName(
            'sk_measurements_profile_entity_int',
            array('entity_id', 'attribute_id', 'store_id'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
        ),
        array('entity_id', 'attribute_id', 'store_id'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE))
    ->addIndex($installer->getIdxName('sk_measurements_profile_entity_int', array('attribute_id')),
        array('attribute_id'))
    ->addIndex($installer->getIdxName('sk_measurements_profile_entity_int', array('store_id')),
        array('store_id'))
    ->addIndex($installer->getIdxName('sk_measurements_profile_entity_int', array('entity_id')),
        array('entity_id'))
    ->addForeignKey(
        $installer->getFkName('sk_measurements_profile_entity_int', 'attribute_id', 'eav/attribute', 'attribute_id'),
        'attribute_id', $installer->getTable('eav/attribute'), 'attribute_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey(
        $installer->getFkName('sk_measurements_profile_entity_int', 'entity_id', 'sk_measurements/profile', 'entity_id'),
        'entity_id', $installer->getTable('sk_measurements/profile'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey(
        $installer->getFkName('sk_measurements_profile_entity_int', 'store_id', 'core/store', 'store_id'),
        'store_id', $installer->getTable('core/store'), 'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Sk Measurements Profile Entity Int');
$installer->getConnection()->createTable($table);
/* Create table 'sk_measurements/profile_entity_text' */
$table = $installer->getConnection()
    ->newTable($installer->getTable('sk_measurements/profile_entity_text'))
    ->addColumn('value_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Value Id')
    ->addColumn('entity_type_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Entity Type Id')
    ->addColumn('attribute_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Attribute Id')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Store ID')
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Entity Id')
    ->addColumn('value', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Value')
    ->addIndex(
        $installer->getIdxName(
            'sk_measurements_profile_entity_text',
            array('entity_id', 'attribute_id', 'store_id'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
        ),
        array('entity_id', 'attribute_id', 'store_id'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE))
    ->addIndex($installer->getIdxName('sk_measurements_profile_entity_text', array('attribute_id')),
        array('attribute_id'))
    ->addIndex($installer->getIdxName('sk_measurements_profile_entity_text', array('store_id')),
        array('store_id'))
    ->addIndex($installer->getIdxName('sk_measurements_profile_entity_text', array('entity_id')),
        array('entity_id'))
    ->addForeignKey(
        $installer->getFkName('sk_measurements_profile_entity_text', 'attribute_id', 'eav/attribute', 'attribute_id'),
        'attribute_id', $installer->getTable('eav/attribute'), 'attribute_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey(
        $installer->getFkName('sk_measurements_profile_entity_text', 'entity_id', 'sk_measurements/profile', 'entity_id'),
        'entity_id', $installer->getTable('sk_measurements/profile'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey(
        $installer->getFkName('sk_measurements_profile_entity_text', 'store_id', 'core/store', 'store_id'),
        'store_id', $installer->getTable('core/store'), 'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Sk Measurements Profile Entity Text');
$installer->getConnection()->createTable($table);

$installer->endSetup();
$installer->installEntities();