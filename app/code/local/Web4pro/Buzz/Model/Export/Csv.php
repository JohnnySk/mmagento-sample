<?php

class Web4pro_Buzz_Model_Export_Csv extends Web4pro_Buzz_Model_Export_Abstract
{
    const ENCLOSURE = '"';
    const DELIMITER = ',';
    protected $_csvRowMap = array(
        'a_row' => array('0', 'weight', 'length', 'width', 'height', 'consignee_name', 'consignee_company_name', 'are_goods_dangerous',
        'insurance_required', 'insurance_amount', 'consignee_address_line_4', 'consignee_suburb', 'consignee_state',
        'consignee_post_code', 'consignee_country', 'consignee_phone_number', 'print_phone_number', '', 'delivery_instructions',
        'signature_required', '', '', 'save_to_address_book', '', 'reference', 'print_reference', '', '', '', '', '', '',
        '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'consignee_email_address',
        'track_advice'),
        'c_row' => array('0', 'weight', 'length', 'charge_code', 'height', 'consignee_name', 'consignee_company_name', 'consignee_address_line_1',
        'consignee_address_line_2', 'consignee_address_line_3', 'consignee_address_line_4', 'consignee_suburb', 'consignee_state', 'consignee_post_code',
        'consignee_country', 'consignee_phone_number', 'print_phone_number', '' ,'delivery_instructions', 'signature_required', '', '',
        'save_to_address_book', '', 'reference', 'print_reference', '', '', '', '', '', '',
            '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'consignee_email_address', 'track_advice')
    );

    public function exportShipments($a, $c)
    {
        $fileName = date('dmY').'_shipment.csv';
        $fp = fopen(Mage::getBaseDir('export') . '/' . $fileName, 'w');
        $aItems = array();
        $cItems = array();
        //set items in arrays
        foreach($a as $aItem) {
            $aItems[] = $aItem;
        }
        foreach($c as $cItem) {
            $cItems[] = $cItem;
        }

        if(count($aItems) == count($cItems)) {
            $number = count($aItems);
            $counter = 0;
            while($number > $counter) {
                $arrayForCsvRow = $this->getDataArrayForCsv($cItems[$counter]);
                fputcsv($fp, $arrayForCsvRow, self::DELIMITER, self::ENCLOSURE);
                $cItems[$counter]->delete();
                $arrayForCsvRow = $this->getDataArrayForCsv($aItems[$counter]);
                $aItems[$counter]->delete();
                fputcsv($fp, $arrayForCsvRow, self::DELIMITER, self::ENCLOSURE);
                $counter++;
            }
            fclose($fp);
            return $fileName;
        } else {
            Mage::getSingleton('core/session')->addError('Error in exporting data, check values in Database');
        }
    }

    public function getDataArrayForCsv($item)
    {
        $resultArray = $item->getData();
        $finalArray = array();
        unset($resultArray['id']);
        unset($resultArray['shipment_id']);
        unset($resultArray['order_id']);
        if($item instanceof Web4pro_Buzz_Model_C) {
            array_unshift($resultArray, 'C');
            $_mapping = $this->getCRowMapping();
        }elseif($item instanceof Web4pro_Buzz_Model_A) {
            $_mapping = $this->getARowMapping();
            array_unshift($resultArray, 'A');
        }
        foreach($resultArray as $key => $value) {
            if($key == 'A' || $key == 'C') {
                continue;
            }

            if(null === $value) {
                $resultArray[$key] = '';
            }

            if ($key == 'are_goods_dangerous') {
                if($value == 'N') {
                    $resultArray[$key] = '';
                }
            }

            if ($key == 'insurance_required') {
                if ($value == 'N') {
                    $resultArray[$key] = '';
                }
            }

            if ($key == 'signature_required') {
                if ($value == 'N') {
                    $resultArray[$key] = '';
                }
            }

            if ($key == 'insurance_amount') {
                if ($value == 0) {
                    $resultArray[$key] = '';
                }
            }

            if($key == 'length' && $value == 0) {
                $resultArray[$key] = '';
            }

            if ($key == 'width' && $value == 0) {
                $resultArray[$key] = '';
            }

            if ($key == 'height' && $value == 0) {
                $resultArray[$key] = '';
            }
        }

        foreach($_mapping as $key => $value) {
            if($value === '') {
                $finalArray[$key] = $value;
            } else {
                $finalArray[$value] = $resultArray[$value];
            }
        }
        return $finalArray;
    }

    public function getCRowMapping()
    {
        return $this->_csvRowMap['c_row'];
    }

    public function getARowMapping()
    {
        return $this->_csvRowMap['a_row'];
    }
}