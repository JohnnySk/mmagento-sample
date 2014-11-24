<?php

class SK_JohnnyPayment_Block_Form extends Mage_Payment_Block_Form
{
    protected function _construct()
    {
        $this->setTemplate('johnnypayment/form/johnnypayment.phtml');
    }

    public function checkMethod()
    {
        $quote = Mage::getModel('checkout/session')->getQuote();
        $quoteData = $quote->getData();
        $grandTotal = $quoteData['grand_total'];
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customerData = Mage::getSingleton('customer/session')->getCustomer();
            $customerObj = Mage::getModel('customer/customer')->load($customerData->getId());
            $balance = $customerObj->getData('balance');
            if($balance < $grandTotal) {
                $redirectUrl = Mage::getBaseUrl();
                Mage::app()->getRequest()->setPost(array('payment' => array('redirect' => $redirectUrl)));
            }
        }
    }
}