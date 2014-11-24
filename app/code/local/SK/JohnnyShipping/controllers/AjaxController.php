<?php

class SK_JohnnyShipping_AjaxController extends Mage_Core_Controller_Front_Action
{
    /**
     * Get Cities
     */
    public function citiesAction()
    {
        if(Mage::app()->getRequest()->isAjax()) {
            $ajaxPost     = Mage::app()->getRequest()->getPost();
            $insertedCity = $ajaxPost['cityValue'];

            //get collections
            $cityCollection     = Mage::getModel('johnnyshipping/city')->getCollection();
            $regionCollection   = Mage::getModel('johnnyshipping/region')->getCollection();
            $districtCollection = Mage::getModel('johnnyshipping/district')->getCollection();

            //get Table Names
            $regionTableName   = $regionCollection->getMainTable();
            $districtTableName = $districtCollection->getMainTable();

            //create select
            $cityCollection->addFieldToSelect('id', 'city_id');
            $cityCollection->addFieldToSelect('name', 'city_name');
            $cityCollection->addFieldToFilter('main_table.name', array('like' => $insertedCity.'%'));

            $cityCollection->getSelect()
                ->joinLeft(
                    array('region' => $regionTableName),
                    'main_table.region = region.id',
                    array('region_name' => 'name')
                )
                ->joinLeft(
                    array('district' => $districtTableName),
                    'main_table.id = district.city_id',
                    array('district_name' => 'name')
                )
                ->order('main_table.id');
            $suggestions = array();

            foreach($cityCollection as  $city) {
                $suggestions[] = $city->getData();
            }

            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($suggestions));
        }
    }
}