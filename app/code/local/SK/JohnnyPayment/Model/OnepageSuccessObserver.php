<?php

class SK_JohnnyPayment_Model_OnepageSuccessObserver
{
    public function removeFundsFromCustomerBalance(Varien_Event_Observer $observer)
    {
        //check the customer
        if(Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customerData = Mage::getSingleton('customer/session')->getCustomer();
            $customerObj = Mage::getModel('customer/customer')->load($customerData->getId());

            $orderId = $observer->getEvent()->getData('order_ids');
            $currentOrder = Mage::getModel('sales/order')->load($orderId[0]);
            $currentOrderData = $currentOrder->getData();
            //get total cost
            $grandTotal = $currentOrderData['grand_total'];

            $balance = $customerObj->getData('balance');
            $newBalance = $balance - $grandTotal;
            //set new balance
            $customerObj->setData('balance', $newBalance);
            $customerObj->save();
        }
    }
}