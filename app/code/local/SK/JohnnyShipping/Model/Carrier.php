<?php

class SK_JohnnyShipping_Model_Carrier extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
    protected $_code = 'johnnyshipping';
    protected $useTariffPlus = false;

    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if(!Mage::getStoreConfig('carriers/'.$this->_code.'/active')) return false;
        $currentQuote     = Mage::getSingleton('checkout/session')->getQuote();
        $result           = Mage::getModel('shipping/rate_result');
        $tariffCollection = Mage::getModel('johnnyshipping/tariff')->getCollection();

        //get city_id value
        $shippingAddress = $currentQuote->getShippingAddress();
        $addressData = $shippingAddress->getData();
        //create select
        $tariffCollection->addFieldToFilter('main_table.city_id', $addressData['city_id']);
        $tariffCollection->getSelect()
            ->order('main_table.id');
        $availableTariffs = array();

        foreach($tariffCollection as $tariff) {
            $availableTariffs[] = $tariff->getData();
        }
        //johnnyshipping is not available for this city
        if(empty($availableTariffs)) return false;
        //key 'package_weight' = weight of product, package_qty = qty
        $rateRequestData = $request->getData();

        $result->append($this->_getStandardShippingRate($availableTariffs, $rateRequestData));
        //$result->append($this->_getExpressShippingRate());
        return $result;
    }

    protected function _getStandardShippingRate($tariffs, $rateRequestData)
    {
        $rate = Mage::getModel('shipping/rate_result_method');
        $rate->setCarrier($this->_code);

        $rate->setCarrierTitle($this->getConfigData('title'));

        $rate->setMethod('standard');
        $rate->setMethodTitle('Standard');

        //get total weight
        $totalWeight = $rateRequestData['package_weight'] * $rateRequestData['package_qty'];

        foreach($tariffs as $tariff) {

            if($tariff['weight_from'] != 0) {
                $tariff['weight_from'] = $tariff['weight_from'] * 1000;
            }

            if($tariff['weight_to'] != 0) {
                $tariff['weight_to'] = $tariff['weight_to'] * 1000;
            } else {
                $this->useTariffPlus = true;
            }

            if($this->useTariffPlus && $tariff['weight_from'] <= $totalWeight) {
                $killogramsOverFrom = ($totalWeight - $tariff['weight_from']) / 1000;
                $resultPrice = $killogramsOverFrom * $tariff['tariff_plus'] + $tariff['tariff'];
                $rate->setPrice($resultPrice);
                $rate->setCost(0);

                return $rate;
            } elseif($totalWeight >= $tariff['weight_from'] && $totalWeight <= $tariff['weight_to']) {
                $rate->setPrice($tariff['tariff']);
                $rate->setCost(0);

                return $rate;
            }
        }
    }

    protected function _getExpressShippingRate()
    {
        $rate = Mage::getModel('shipping/rate_result_method');

        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod('express');
        $rate->setMethodTitle('Express');
        $rate->setPrice(12.99);
        $rate->setCost(0);
        return $rate;
    }

    public function getAllowedMethods()
    {
        return array(
            'standard' => 'Standard',
            'express' => 'Express',
        );
    }

    public function isTrackingAvailable()
    {
        return true;
    }

}