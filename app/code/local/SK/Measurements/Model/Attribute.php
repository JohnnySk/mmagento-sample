<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 08.01.15
 * Time: 18:25
 */

class SK_Measurements_Model_Attribute extends Mage_Eav_Model_Entity_Attribute
{
    const SCOPE_STORE   = 0;
    const SCOPE_GLOBAL  = 1;
    const SCOPE_WEBSITE = 2;
    const MODULE_NAME   = 'SK_Measurements';
    const ENTITY        = 'sk_measurements_profile_eav_attribute';

    protected $_eventPrefix   = 'sk_measurements_profile_entity_attribute';
    protected $_eventObject   = 'attribute';
    protected $_labels = null;

    protected function _construct()
    {
        $this->_init('sk_measurements/attribute');
    }

    protected function _beforeSave()
    {
        $this->setData('modulePrefix', self::MODULE_NAME);
        if (isset($this->_origData['is_global'])) {
            if (!isset($this->_data['is_global'])) {
                $this->_data['is_global'] = self::SCOPE_GLOBAL;
            }
        }
        if ($this->getFrontendInput() == 'textarea') {
            if ($this->getIsWysiwygEnabled()) {
                $this->setIsHtmlAllowedOnFront(1);
            }
        }
        return parent::_beforeSave();
    }

    protected function _afterSave()
    {
        Mage::getSingleton('eav/config')->clear();
        return parent::_afterSave();
    }

    public function getIsGlobal()
    {
        return $this->_getData('is_global');
    }

    /***/
    public function isScopeGlobal()
    {
        return $this->getIsGlobal() == self::SCOPE_GLOBAL;
    }

    public function isScopeWebsite()
    {
        return $this->getIsGlobal() == self::SCOPE_WEBSITE;
    }

    public function isScopeStore()
    {
        return !$this->isScopeGlobal() && !$this->isScopeWebsite();
    }

    public function getStoreId()
    {
        $dataObject = $this->getDataObject();
        if ($dataObject) {
            return $dataObject->getStoreId();
        }
        return $this->getData('store_id');
    }

    public function getSourceModel()
    {
        $model = $this->getData('source_model');
        if (empty($model)) {
            if ($this->getBackendType() == 'int' && $this->getFrontendInput() == 'select') {
                return $this->_getDefaultSourceModel();
            }
        }
        return $model;
    }

    public function getFrontendLabel()
    {
        return $this->_getData('frontend_label');
    }

    protected function _getLabelForStore()
    {
        return $this->getFrontendLabel();
    }

    public function _getDefaultSourceModel()
    {
        return 'eav/entity_attribute_source_table';
    }
    
}