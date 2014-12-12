<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 02.12.14
 * Time: 14:44
 */
class SK_Measurements_Model_Resource_Profile extends Mage_Eav_Model_Entity_Abstract
{
    /***/
    public function __construct()
    {
        $resource = Mage::getSingleton('core/resource');

        $this->setType(SK_Measurements_Model_Profile::ENTITY);

        $this->setConnection(
            $resource->getConnection('sk_measurements_read'),
            $resource->getConnection('sk_measurements_write')
        );
    }
}