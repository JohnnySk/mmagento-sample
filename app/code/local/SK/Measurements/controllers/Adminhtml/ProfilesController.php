<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 05.12.14
 * Time: 13:41
 */

class SK_Measurements_Adminhtml_ProfilesController extends Mage_Adminhtml_Controller_Action
{
    /***/
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('measurements');
        
        $contentBlock = $this->getLayout()->createBlock('sk_measurements/adminhtml_profiles');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    public function newAction()
    {

    }
}