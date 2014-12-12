<?php

class Web4pro_Buzz_EparcelController extends Mage_Adminhtml_Controller_Action
{
    public function saveEparcelAction()
    {
        if ($shipmentId = Mage::app()->getRequest()->getParam('id')) {
            if (Mage::app()->getRequest()->isAjax()) {
                $postData = Mage::app()->getRequest()->getPost();

                Mage::helper('buzz')->saveEparcel($postData, $shipmentId);
                echo $this->__('You will be redirected to the referer page');
            }
        }
    }
    
    public function invokeSelectedAction()
    {
        $orderIds = $this->getRequest()->getPost('order_ids', array());
        //get ids from A and C tables
        $collectionForA = Mage::getModel('buzz/a')->getCollection();
        $collectionForA->addFieldToFilter('order_id', array('in' => $orderIds));
        $collectionForC = Mage::getModel('buzz/c')->getCollection();
        $collectionForC->addFieldToFilter('order_id', array('in' => $orderIds));
        $file = Mage::getModel('buzz/export_csv')->exportShipments($collectionForA, $collectionForC);

        if ($file) {
            $this->_prepareDownloadResponse($file, file_get_contents(Mage::getBaseDir('export') . '/' . $file));
        } else {
            $this->_redirectReferer();
        }
    }
}