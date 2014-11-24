<?php

class SK_Simple_Model_Observer
{
    public function interceptAddedProduct(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();
        $item = $event->getQuoteItem();
        $product = $item->getProduct();
        //get product's crossSells
        $crossSells = $product->getCrossSellProducts();
        $block_class_name = Mage::getConfig()->getBlockClassName('simple/crossblock');
        $cart = Mage::getSingleton('checkout/cart');
        $methods = get_class_methods($cart);
        //has current product cross sells or not?
        if($crossSells) {
            //$crossblock = Mage::getConfig()->getBlockClassName('simple.crossblock');
        } else {

        }

        //debug
/*
        Zend_Debug::dump($crossSells, 'dump');
        exit;*/
    }
}