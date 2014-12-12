<?php

class Web4pro_Buzz_Model_Observer
{
    /**
     * Extends the mass action select box to append the option to export to csv.
     * Event: core_block_abstract_prepare_layout_before
     */

    public function addMassaction($observer)
    {
        $block = $observer->getEvent()->getBlock();
        if (get_class($block) == 'Mage_Adminhtml_Block_Widget_Grid_Massaction'
            && $block->getRequest()->getControllerName() == 'sales_order'
        ) {
            $block->addItem('buzzshipmentsexport', array(
                'label' => 'Generate eParcel CSV',
                'url' => Mage::app()->getStore()->getUrl('eparcel_admin/eparcel/invokeSelected'),
            ));
        }
    }
    
    public function saveEparcelData($observer)
    {
        $shipment   = $observer->getEvent()->getShipment();
        $shipmentId = $shipment->getEntityId();
        $postData = Mage::app()->getRequest()->getPost();

        Mage::helper('buzz')->saveEparcel($postData, $shipmentId);
    }
}