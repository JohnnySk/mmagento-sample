<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 02.12.14
 * Time: 14:43
 */
class SK_Measurements_Model_Profile extends Mage_Core_Model_Abstract
{
    const ENTITY = 'sk_measurements_profile';

    protected $_eventPrefix = 'sk_measurements';
    protected $_eventObject = 'profile';

    function _construct()
    {
        $this->_init('sk_measurements/profile');
    }
}