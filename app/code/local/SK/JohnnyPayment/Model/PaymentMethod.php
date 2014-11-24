<?php

class SK_JohnnyPayment_Model_PaymentMethod extends Mage_Payment_Model_Method_Abstract
{
    /**
     * unique internal payment method identifier
     *
     * @var string [a-z0-9_]
     */
    protected $_code = 'johnnypayment';

    protected $_canCancelInvoice = false;

    public $_redirectUrl = '';

    /**
     * html form for payment method
     */
    protected $_formBlockType = 'johnnypayment/form';

    protected $_infoBlockType = 'johnnypayment/info';


    public function assignData($data)
    {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }
        $info = $this->getInfoInstance();
        $info->setCheckNo($data->getCheckNo())
            ->setCheckDate($data->getCheckDate());
        return $this;
    }


    public function validate()
    {
        parent::validate();

        $info = $this->getInfoInstance();
        $no = $info->getCheckNo();
        $date = $info->getCheckDate();
        if (empty($no) || empty($date)) {
            $errorCode = 'invalid_data';
            $errorMsg = $this->_getHelper()->__('Check No and Date are required fields');
        }

        $quote = Mage::getModel('checkout/session')->getQuote();
        $quoteData = $quote->getData();
        $grandTotal = $quoteData['grand_total'];
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customerData = Mage::getSingleton('customer/session')->getCustomer();
            $customerObj = Mage::getModel('customer/customer')->load($customerData->getId());
            $balance = $customerObj->getData('balance');
            if ($balance < $grandTotal) {
                $checkout = Mage::getSingleton('checkout/session');
                $checkout->addError("Your balance is less then total cost of products");
                $this->_redirectUrl =  Mage::getUrl('checkout/cart');
            }
        }

        if (isset($errorMsg)) {
            Mage::throwException($errorMsg);
        }

        return $this;
    }

    /**
     * Return redirect url
     * getOrderPlaceRedirectUrl
     * @return string
     */
    public function getCheckoutRedirectUrl()
    {
        return $this->_redirectUrl;
    }

    /**
     * Cancel payment abstract method
     *
     * @param Varien_Object $payment
     *
     * @return Mage_Payment_Model_Abstract
     */
    public function cancel(Varien_Object $payment)
    {
        return $this;
    }

}