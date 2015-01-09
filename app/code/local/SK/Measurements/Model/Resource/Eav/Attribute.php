<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 09.01.15
 * Time: 11:36
 */

class SK_Measurements_Model_Resource_Eav_Attribute extends Mage_Eav_Model_Entity_Attribute
{
    const MODULE_NAME = 'SK_Measurements';
    const ENTITY = 'sk_measurements_eav_attribute';
    protected $_eventPrefix = 'sk_measurements_entity_attribute';
    protected $_eventObject = 'attribute';
    static protected $_labels = null;

    protected function _construct()
    {
        $this->_init('sk_measurements/eav_attribute');
    }

    public function isScopeStore()
    {
        return $this->getIsGlobal() == Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE;
    }

    public function isScopeWebsite()
    {
        return $this->getIsGlobal() == Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE;
    }

    public function isScopeGlobal()
    {
        return (!$this->isScopeStore() && !$this->isScopeWebsite());
    }

    public function getBackendTypeByInput($type)
    {
        switch ($type) {
            case 'file':
                //intentional fallthrough
            case 'image':
                return 'varchar';
                break;
            default:
                return parent::getBackendTypeByInput($type);
                break;
        }
    }

    protected function _beforeDelete()
    {
        if (!$this->getIsUserDefined()) {
            throw new Mage_Core_Exception(Mage::helper('sk_measurements')->__('This attribute is not deletable'));
        }
        return parent::_beforeDelete();
    }
}