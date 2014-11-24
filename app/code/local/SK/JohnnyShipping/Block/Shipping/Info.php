<?php

class SK_JohnnyShipping_Block_Shipping_Info extends Mage_Core_Block_Template
{
    /**
     * Retrieve is allow and show block
     *
     * @return bool
     */
    public function isShow()
    {
        return !$this->getQuote()->isVirtual();
    }
}