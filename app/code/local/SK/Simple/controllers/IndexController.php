<?php
class SK_Simple_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
    public function addAction()
    {
        //get post params
        $crossSellsToAdd = $this->getRequest()->getPost();
        //get store id
        $storeId = Mage::app()->getStore()->getId();
        foreach($crossSellsToAdd as $name => $productId) {
            $product = Mage::getModel('catalog/product')
                ->setStoreId($storeId)
                ->load($productId);
            $session = Mage::getSingleton('core/session', array('name' => 'frontend'));
            $cart = Mage::helper('checkout/cart')->getCart();
            $cart->addProduct($product, 1);
        }
        if(isset($cart)) {
            $cart->save();
            $session->setCartWasUpdated(true);
        }

        //redirect to cart
        $this->_redirect('checkout/cart/');
    }

}