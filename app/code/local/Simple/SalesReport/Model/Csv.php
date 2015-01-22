<?php
class Simple_SalesReport_Model_Csv extends Mage_Core_Model_Abstract
{
    const ENCLOSURE = '"';
    const DELIMITER = ',';

    
    protected $_csvFile;
    protected $_csvFileName;
    
    /**
     * Prepares simple sales report according to given 
     * @param object $data Description
     * @return object  Description
     */
    public function prepareSalesReport($postData)
    {
        $helper = Mage::helper('salesreport');
        $post = new Varien_Object($postData);

        //dates validation
        if (!strtotime($post->getDateFrom()) || !strtotime($post->getDateTo()) ||
            (strtotime($post->getDateFrom()) > strtotime($post->getDateTo()))) {

            Mage::getSingleton('adminhtml/session')->addError($helper->__('Invalid dates information'));
            return false;
        }

        //preparing orders collection according to pointed period
        $orders = Mage::getModel('sales/order')->getCollection();
        $connection = $orders->getResource();
        $select = $orders->getSelect();
            //adding shipping address data to resulting collection
        $select->joinLeft(array('soa' => $connection->getTable('sales/order_address')),
                'main_table.entity_id = soa.parent_id and soa.address_type=\'shipping\'');
            //adding dates filter
        $dateModel = Mage::getModel('core/date');
        $dateFrom = $dateModel->date('Y-m-d', strtotime($post->getDateFrom()));
        $dateTo = $dateModel->date('Y-m-d', strtotime($post->getDateTo()));
        $orders->addAttributeToFilter('created_at', array('from' => $dateFrom, 'to' => $dateTo));

        //creating CSV-file if collection isn't empty
        if (count($orders)) {
            $this->_prepareCsvFile();
            foreach ($orders as $order) {
                $this->_writeOrderRow($order);
            }
            return $this->_closeCsvFile();
        } else {
            Mage::getSingleton('adminhtml/session')->addNotice($helper->__('There are no orders made durring pointed period'));
            return false;
        }
    }

    /**
     * @return array Array with column names of CSV file 
     */
    protected function _getCsvHeaderFields()
    {
        return array (
                'Order #',
                'Purchased On',
                'G.T. (Purchased)',
                'Status',
                'Region',
                'City',
                'Zip Code',
                'Tax Invoiced',
            );
    }

    /**
     * Prepares a row sorted with by keys to fit values to CSV column names
     * @return array
     */
    protected function _getKeySortedEmptyRow()
    {
        return array (
                'increment_id' => '',
                'created_at'   => '',
                'grand_total'  => '',
                'status'       => '',
                'region'       => '',
                'city'         => '',
                'postcode'     => '',
                'tax_invoiced' => '',
        );
    }

    /**
     * Writing a new code
     * @param object $order Order data 
     */
    protected function _writeOrderRow($order)
    {
        $row = $this->_getKeySortedEmptyRow();

        foreach (array_keys($row) as $fieldName) {
            if ($value = $order->getData($fieldName)) {
                $row[$fieldName] = $value;
            }
        }

        //curency fields formatting
        $currencyCode = $order->getData('order_currency_code');
        $row['grand_total'] = $this->_formatCurrency($row['grand_total'], $currencyCode);
        if (!empty($row['tax_invoiced'])) {
            $row['tax_invoiced'] = $this->_formatCurrency($row['tax_invoiced'], $currencyCode);
        }

        //writing row to file
        fputcsv($this->_csvFile, $row, self::DELIMITER, self::ENCLOSURE);
    }

    /**
     * Opens a new CSV file and writes a header(column names)
     */
    protected function _prepareCsvFile()
    {
        //opening file and preparing environment
        $this->_csvFileName = 'order_export_' . date("Ymd_His") . '.csv';
        $this->_csvFile = fopen($this->getExportDir() . '/' . $this->_csvFileName, 'w');

        //writting a head row
        fputcsv($this->_csvFile, $this->_getCsvHeaderFields(), self::DELIMITER, self::ENCLOSURE);
    }

    /**
     * Closes csv file and returns filename for download response
     * @return string
     */
    protected function _closeCsvFile()
    {
        fclose($this->_csvFile);
        return $this->_csvFileName;
    }

    public function getExportDir()
    {
        return Mage::getBaseDir('export');
    }

    /**
     * Adds currency symbol to given string
     * @param decimal $price
     * @param string $currency_code
     * @return string 
     */
    protected function _formatCurrency($price, $currency_code){
        $price = sprintf('%f', $price);
        return Mage::app()->getLocale()->currency($currency_code)->toCurrency($price);
    }
}
