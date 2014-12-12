<?php

class Web4pro_Buzz_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @param $postData
     * @param $shipmentId
     */
    public function saveEparcel($postData, $shipmentId)
    {
        $responceStatus = array();
        if (isset($postData['buzz_a']) && isset($postData['buzz_c'])) {
            //check if isset data for current shipment
            $collectionForA = Mage::getModel('buzz/a')->getCollection();
            $collectionForA->addFieldToFilter('shipment_id', array('eq' => $shipmentId));
            $collectionForC = Mage::getModel('buzz/c')->getCollection();
            $collectionForC->addFieldToFilter('shipment_id', array('eq' => $shipmentId));
            if (count($collectionForA) && count($collectionForC)) {
                //make update
                foreach ($collectionForA as $item) {
                    $item->addData($postData['buzz_a']);
                    $item->save();
                    $responceStatus['a'] = 'update';
                }
                foreach ($collectionForC as $item) {
                    $item->addData($postData['buzz_c']);
                    $item->save();
                    $responceStatus['c'] = 'update';
                }
            } else {
                //set shipment id
                $postData['buzz_a']['order_id'] = $postData['buzz_order_id'];
                $postData['buzz_a']['shipment_id'] = $shipmentId;

                //get a model
                $model = Mage::getModel('buzz/a')->setData($postData['buzz_a']);
                try {
                    $model->save();
                    $responceStatus['a'] = 'insert';
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                //set shipment id
                $postData['buzz_c']['order_id'] = $postData['buzz_order_id'];
                $postData['buzz_c']['shipment_id'] = $shipmentId;

                //get c model
                $model = Mage::getModel('buzz/c')->setData($postData['buzz_c']);
                try {
                    $model->save();
                    $responceStatus['c'] = 'insert';
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
            if (!empty($responceStatus) && $responceStatus['a'] == 'insert' && $responceStatus['c'] == 'insert') {
                Mage::getSingleton('core/session')->addSuccess('Data successfully inserted');
            } elseif (!empty($responceStatus) && $responceStatus['a'] == 'update' && $responceStatus['c'] == 'update') {
                Mage::getSingleton('core/session')->addSuccess('Data successfully Updated');
            } else {
                Mage::getSingleton('core/session')->addError('Error in exporting data, check values in Database');
            }
        }
    }
}