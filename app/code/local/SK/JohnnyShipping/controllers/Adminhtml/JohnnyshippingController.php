<?php

class SK_JohnnyShipping_Adminhtml_JohnnyshippingController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('johnnyshipping');


        $contentBlock = $this->getLayout()->createBlock('johnnyshipping/adminhtml_johnnyshipping');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        Mage::register('current_tariff', Mage::getModel('johnnyshipping/tariff')->load($id));

        $this->loadLayout()->_setActiveMenu('johnnyshipping');
        $this->_addContent($this->getLayout()->createBlock('johnnyshipping/adminhtml_johnnyshipping_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        if($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('johnnyshipping/tariff');
                $model->setData($data)->setId($this->getRequest()->getParam('id'));
                if (!$model->getCreated()) {
                    $model->setCreated(now());
                }
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Tariff was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }
            return;
        }

        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('johnnyshipping/tariff')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Tariff was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $tariffs = $this->getRequest()->getParam('tariffs', null);

        if (is_array($tariffs) && sizeof($tariffs) > 0) {
            try {
                foreach ($tariffs as $id) {
                    Mage::getModel('johnnyshipping/tariff')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d tariffs have been deleted', sizeof($tariffs)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select tariffs'));
        }
        $this->_redirect('*/*');
    }
}