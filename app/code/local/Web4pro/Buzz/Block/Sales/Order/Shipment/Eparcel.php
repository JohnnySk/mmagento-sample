<?php

class Web4pro_Buzz_Block_Sales_Order_Shipment_Eparcel extends Mage_Adminhtml_Block_Template
{
    public $_needSaveButton = false;
    /**
     * Retrieve shipment model instance
     *
     * @return Mage_Sales_Model_Order_Shipment
     */
    public function getShipment()
    {
        return Mage::registry('current_shipment');
    }

    /**
     * Retrieve invoice order
     *
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        return $this->getShipment()->getOrder();
    }


    /**
     * Retrieve total Weight of shipment
     *
     * @return decimal
     */
    public function getTotalWeight()
    {
        $totalWeight = 0;
        foreach ($this->getShipment()->getAllItems() as $item) {
             $totalWeight += $item->getWeight();
        }
        return $totalWeight;
    }

    /**
     * Get Region Code By Id
     *
     * @return string
     */
    public function getRegionCodeById($regionId)
    {
        $region = Mage::getModel('directory/region')->load($regionId);
        if($region->getCode()) {
            $regionCode = $region->getCode();
        } else {
            $regionCode = '';
        }
        return $regionCode;
    }

    /**
     * Prepare child blocks
     *
     * @return Mage_Adminhtml_Block_Sales_Order_Invoice_Create_Items
     */
    protected function _prepareLayout()
    {
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
                'id' => 'save_eparcel_button',
                'label' => Mage::helper('sales')->__('Save'),
                'class' => 'save'
            ));
        $this->setChild('save_eparcel_button', $button);

        return parent::_prepareLayout();
    }

    public function getSubmitUrl()
    {
        return $this->getUrl('eparcel_admin/eparcel/saveEparcel', array('id' => $this->getShipment()->getEntityId()));
    }

    public function _toHtml()
    {
        //if this shipment is created, run method to choose the template
        if($this->getShipment()->getEntityId()) {
            $templateFile = $this->chooseTheTemplate();
            $this->_needSaveButton = true;
        } else {
            $templateFile = 'buzz/order_info/eparcel.phtml';
        }

        $this->setTemplate($templateFile);
        return parent::_toHtml();
    }

    /**
     *
     */
    public function getC($shipmentId)
    {
        $entityA = Mage::getModel('buzz/C')->load($shipmentId, 'shipment_id');

        return $entityA;
    }

    /**
     *
     */
    public function getA($shipmentId)
    {
        $entityA = Mage::getModel('buzz/A')->load($shipmentId, 'shipment_id');

        return $entityA;
    }

    /**
     *
     * @return string
     */
    protected function chooseTheTemplate()
    {
        $shipmentId = $this->getShipment()->getEntityId();
        $entityC = $this->getC($shipmentId);
        $entityA = $this->getA($shipmentId);
        $templateFile = 'buzz/order_info/eparcel.phtml';
        if($entityA->getId() && $entityC->getId()) {
            $templateFile = 'buzz/eparcel_info/eparcel.phtml';
        }

        return $templateFile;
    }
}