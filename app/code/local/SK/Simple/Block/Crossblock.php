<?php

class SK_Simple_Block_Crossblock extends Mage_Catalog_Block_Product_Abstract
{
    protected $max = 3;
    private $checker;

    public function getBlockItems()
    {
        $session = Mage::getSingleton('checkout/session')->getQuote();
        $cart = Mage::helper('checkout/cart')->getCart();
        $cartItems = $session->getAllItems();
        if($cartItems) {
            $items = array();

            foreach($cartItems as $item) {
                //get current product
                $product = $item->getProduct();
                //get array crosssells of current product
                $crossSells = $product->getCrossSellProducts();
                foreach($crossSells as $crossSell) {
                    $productObj = Mage::getModel('catalog/product');
                    //check if this item already in cart
                    foreach ($cart->getItems() as $item) {
                        if($item->getProductId() == $crossSell->getId()) $this->checker = true;
                    }
                    if(!$this->checker) $items[] = $productObj->load($crossSell->getId());
                    $this->checker = null;
                }

            }

            if(!empty($items)) {
                return $items;
            }
        }
    }

    public function getItemsCount() {
        return count($this->getBlockItems());
    }

}