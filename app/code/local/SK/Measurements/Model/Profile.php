<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 02.12.14
 * Time: 14:43
 */
class SK_Measurements_Model_Profile extends Mage_Core_Model_Abstract
{
    const ENTITY    = 'sk_measurements_profile';
    const CACHE_TAG = 'sk_measurements_profile';

    protected $_eventPrefix = 'sk_measurements_profile';
    protected $_eventObject = 'profile';

    function _construct()
    {
        parent::_construct();
        $this->_init('sk_measurements/profile');
    }
    
    protected function _beforeSave()
    {
        parent::_beforeSave();
        $dataNow = Mage::getSingleton('core/date')->gmtDate();
        if($this->isObjectNew()) {
            $this->setCreatedAt($dataNow);
        }

        $this->setUpdatedAt($dataNow);
        return $this;
    }

    public function getDefaultAttributeSetId()
    {
        return $this->getResource()->getEntityType()->getDefaultAttributeSetId();
    }

    public function getAttributeText($attributeCode)
    {
        $text = $this->getResource()
            ->getAttribute($attributeCode)
            ->getSource()
            ->getOptionText($this->getData($attributeCode));
        if (is_array($text)) {
            return implode(', ', $text);
        }
        return $text;
    }


}