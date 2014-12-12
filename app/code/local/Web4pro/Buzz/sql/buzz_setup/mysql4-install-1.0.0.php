<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @author     Igor Shapoval
 * @category   Web4pro
 * @package    Web4pro_Buzz
 * @copyright  (c) Web4pro - internet solutions for business. <info@web4pro.com.ua>. All rights reserved.
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/**
 * Create table buzz_eparcel_c
 */
$table = $installer->getConnection()

    ->newTable($installer->getTable('buzz/c'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true,
    ), 'ID')
    ->addColumn('shipment_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
    ), 'Shipment ID')
    ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
    ), 'Order ID')
    ->addColumn('weight', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
        'default'  => null,
    ), 'Weight')
    ->addColumn('length', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
        'default'  => null,
    ), 'Length')
    ->addColumn('charge_code', Varien_Db_Ddl_Table::TYPE_VARCHAR, 20, array(
        'nullable' => false
    ), 'Width')
    ->addColumn('height', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true
    ), 'Height')
    ->addColumn('consignee_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Consignee Name')
    ->addColumn('consignee_company_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Consignee Company Name')
    ->addColumn('consignee_address_line_1', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'Consignee Address Line 1')
    ->addColumn('consignee_address_line_2', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Consignee Address Line 2')
    ->addColumn('consignee_address_line_3', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
        'default'  => null,
    ), 'Consignee Address Line 3')
    ->addColumn('consignee_address_line_4', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
        'default'  => null,
    ), 'Consignee Address Line 4')
    ->addColumn('consignee_suburb', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Consignee Suburb')
    ->addColumn('consignee_state', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Consignee State')
    ->addColumn('consignee_post_code', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
    ), 'Consignee Post Code')
    ->addColumn('consignee_country', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false,
    ), 'Consignee Country')
    ->addColumn('consignee_phone_number', Varien_Db_Ddl_Table::TYPE_VARCHAR, 128, array(
        'nullable' => true,
    ), 'Consignee Phone Number')
    ->addColumn('print_phone_number', Varien_Db_Ddl_Table::TYPE_CHAR, 1, array(
        'nullable' => false,
    ), 'Print Phone Number?')
    ->addColumn('delivery_instructions', Varien_Db_Ddl_Table::TYPE_VARCHAR, 128, array(
        'nullable' => true,
    ), 'Delivery Instructions')
    ->addColumn('signature_required', Varien_Db_Ddl_Table::TYPE_CHAR, 1, array(
        'nullable' => false,
        'default' => 'Y',
    ), 'Signature Required?')
    ->addColumn('save_to_address_book', Varien_Db_Ddl_Table::TYPE_CHAR, 1, array(
        'nullable' => false,
        'default' => 'Y',
    ), 'Save to address book?')
    ->addColumn('reference', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
    ), 'Reference')
    ->addColumn('print_reference', Varien_Db_Ddl_Table::TYPE_CHAR, 1, array(
        'nullable' => false,
        'default' => 'Y',
    ), 'Print Reference?')
    ->addColumn('consignee_email_address', Varien_Db_Ddl_Table::TYPE_VARCHAR, 128, array(
        'nullable' => true,
    ), 'Consignee Email Address')
    ->addColumn('track_advice', Varien_Db_Ddl_Table::TYPE_VARCHAR, 128, array(
        'nullable' => true,
    ), 'Track Advice')
    ->addForeignKey('c_shipment_id', 'shipment_id', $installer->getTable('sales/shipment'), 'entity_id');

$installer->getConnection()->createTable($table);

/**
 * Create table buzz_eparcel_a
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('buzz/a'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'ID')
    ->addColumn('shipment_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
    ), 'Shipment ID')
    ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
    ), 'Order ID')
    ->addColumn('weight', Varien_Db_Ddl_Table::TYPE_DECIMAL, array(12,4), array(
        'nullable' => true,
        'default' => null,
    ), 'Weight')
    ->addColumn('length', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
        'default' => 28,
    ), 'Length')
    ->addColumn('width', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
        'default'  => 23,
    ), 'Width')
    ->addColumn('height', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
        'default'  => 3,
    ), 'Height')
    ->addColumn('consignee_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Consignee Name')
    ->addColumn('consignee_company_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Consignee Company Name')
    ->addColumn('are_goods_dangerous', Varien_Db_Ddl_Table::TYPE_CHAR, 1, array(
        'nullable' => true,
        'default'  => null,
    ), 'Are Goods Dangerous?')
    ->addColumn('insurance_required', Varien_Db_Ddl_Table::TYPE_CHAR, null, array(
        'nullable' => true,
        'default'  => null,
    ), 'Insurance required?')
    ->addColumn('insurance_amount', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
        'default' => null,
    ), 'Insurance amount')
    ->addColumn('consignee_address_line_4', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
        'default' => null,
    ), 'Consignee Address Line 4')
    ->addColumn('consignee_suburb', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Consignee Suburb')
    ->addColumn('consignee_state', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Consignee State')
    ->addColumn('consignee_post_code', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
    ), 'Consignee Post Code')
    ->addColumn('consignee_country', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
        'default' => null,
    ), 'Consignee Country')
    ->addColumn('consignee_phone_number', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
    ), 'Consignee Phone Number')
    ->addColumn('print_phone_number', Varien_Db_Ddl_Table::TYPE_CHAR, 1, array(
        'nullable' => true,
    ), 'Print Phone Number?')
    ->addColumn('delivery_instructions', Varien_Db_Ddl_Table::TYPE_VARCHAR, 128, array(
        'nullable' => true,
    ), 'Delivery Instructions')
    ->addColumn('signature_required', Varien_Db_Ddl_Table::TYPE_CHAR, null, array(
        'nullable' => true,
        'default' => null,
    ), 'Signature Required?')
    ->addColumn('save_to_address_book', Varien_Db_Ddl_Table::TYPE_CHAR, null, array(
        'nullable' => true,
        'default' => null,
    ), 'Save to address book?')
    ->addColumn('reference', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
    ), 'Reference')
    ->addColumn('print_reference', Varien_Db_Ddl_Table::TYPE_CHAR, null, array(
        'nullable' => true,
        'default' => null,
    ), 'Print Reference?')
    ->addColumn('consignee_email_address', Varien_Db_Ddl_Table::TYPE_VARCHAR, 128, array(
        'nullable' => true,
    ), 'Consignee Email Address')
    ->addColumn('track_advice', Varien_Db_Ddl_Table::TYPE_VARCHAR, 128, array(
        'nullable' => true,
    ), 'Track Advice')
    ->addForeignKey('a_shipment_id', 'shipment_id', $installer->getTable('sales/shipment'), 'entity_id');

$installer->getConnection()->createTable($table);

$installer->endSetup();
