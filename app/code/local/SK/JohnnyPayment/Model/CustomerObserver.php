<?php

class SK_JohnnyPayment_Model_CustomerObserver
{
    public function interceptNewCustomer(Varien_Event_Observer $observer)
    {
        $customer = $observer->getCustomer();
        //use standard setter
        $customer->setData('balance', 5);
    }
}