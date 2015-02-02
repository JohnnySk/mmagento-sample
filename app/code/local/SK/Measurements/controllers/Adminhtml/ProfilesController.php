<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 05.12.14
 * Time: 13:41
 */

class SK_Measurements_Adminhtml_ProfilesController extends Mage_Adminhtml_Controller_Action
{

    protected function _construct()
    {
        $this->setUsedModuleName('Sk_Measurements');
    }

    protected function _initProfile()
    {
        $this->_title($this->__('Measurements'))
            ->_title($this->__('Manage Profiles'));

        $profileId = (int)$this->getRequest()->getParam('id');
        $profile = Mage::getModel('sk_measurements/profile');

        if ($profileId) {
            $profile->load($profileId);
        }
        Mage::register('current_profile', $profile);
        return $profile;
    }
    /***/
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('measurements');

        /**
         * This functional exists in layout
         */
        //$contentBlock = $this->getLayout()->createBlock('sk_measurements/adminhtml_profiles');
        //$this->_addContent($contentBlock);
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        /*
        $id = (int)$this->getRequest()->getParam('id');
        Mage::register('current_profile', Mage::getModel('sk_measurements/profile')->load($id));

        $this->loadLayout()->_setActiveMenu('measurements');
        $this->_addContent($this->getLayout()->createBlock('sk_measurements/adminhtml_profiles_edit'));
        $this->renderLayout();
        */

        $profileId = (int)$this->getRequest()->getParam('id');

        $profile = $this->_initProfile();
        if ($profileId && !$profile->getId()) {
            $this->_getSession()->addError(Mage::helper('sk_measurements')->__('This profile no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }
        if ($data = Mage::getSingleton('adminhtml/session')->getProfileData(true)) {
            $profile->setData($data);
        }
        $this->_title($profile->getTitle());
        Mage::dispatchEvent('sk_measurements_profile_edit_action', array('profile' => $profile));
        $this->loadLayout();
        /*if ($profile->getId()) {
            if (!Mage::app()->isSingleStoreMode() && ($switchBlock = $this->getLayout()->getBlock('store_switcher'))) {
                $switchBlock->setDefaultStoreName(Mage::helper('sk_measurements')->__('Default Values'))*/
                    //->setSwitchUrl($this->getUrl('*/*/*', array('_current' => true, 'active_tab' => null, 'tab' => null, 'store' => null)));
           /* }
        } else {
            $this->getLayout()->getBlock('left')->unsetChild('store_switcher');
        }*/
        //$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();
    }

    public function saveAction()
    {
        //$storeId = $this->getRequest()->getParam('store');
        $isEdit = (int)($this->getRequest()->getParam('id') != null);
        $data = $this->getRequest()->getPost();
        if ($data) {
            $profile = $this->_initProfile();
            $profileData = $this->getRequest()->getPost('profile', array());
            $profile->addData($profileData);
            $profile->setAttributeSetId($profile->getDefaultAttributeSetId());

            try {
                //we have an error in save method
                $profile->save();
                $profileId = $profile->getId();
                $this->_getSession()->addSuccess(Mage::helper('sk_measurements')->__('Profile was saved'));
            } catch (Mage_Core_Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError($e->getMessage())
                    ->setProfileData($profileData);
                $redirectBack = true;
            } catch (Exception $e) {
                Mage::logException($e);
                $this->_getSession()->addError(Mage::helper('sk_measurements')->__('Error saving profile'))
                    ->setProfileData($profileData);
                $redirectBack = true;
            }
        }
        if ($redirectBack) {
            $this->_redirect('*/*/edit', array(
                'id' => $profileId,
                '_current' => true
            ));
        } else {
            $this->_redirect('*/*/', array('store' => $storeId));
        }
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            $profile = Mage::getModel('sk_measurements/profile')->load($id);
            try {
                $profile->delete();
                $this->_getSession()->addSuccess(Mage::helper('sk_measurements')->__('The profile has been deleted.'));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->getResponse()->setRedirect($this->getUrl('*/*/', array('store' => $this->getRequest()->getParam('store'))));
    }

    public function massDeleteAction()
    {
        $profileIds = $this->getRequest()->getParam('profile');
        if (!is_array($profileIds)) {
            $this->_getSession()->addError($this->__('Please select profiles.'));
        } else {
            try {
                foreach ($profileIds as $profileId) {
                    $profile = Mage::getSingleton('sk_measurements/profile')->load($profileId);
                    Mage::dispatchEvent('sk_measurements_controller_profile_delete', array('profile' => $profile));
                    $profile->delete();
                }
                $this->_getSession()->addSuccess(
                    Mage::helper('sk_measurements')->__('Total of %d record(s) have been deleted.', count($profileIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction()
    {
        $profileIds = $this->getRequest()->getParam('profile');
        if (!is_array($profileIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sk_measurements')->__('Please select profiles.'));
        } else {
            try {
                foreach ($profileIds as $profileId) {
                    $profile = Mage::getSingleton('sk_measurements/profile')->load($profileId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d profiles were successfully updated.', count($profileIds)));
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sk_measurements')->__('There was an error updating profiles.'));
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/easylife_news/article');
    }

    public function exportCsvAction()
    {
        $fileName = 'profiles.csv';
        $content = $this->getLayout()->createBlock('sk_measurements/adminhtml_profile_grid')
            ->getCsvFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportExcelAction()
    {
        $fileName = 'article.xls';
        $content = $this->getLayout()->createBlock('easylife_news/adminhtml_article_grid')
            ->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName = 'profile.xml';
        $content = $this->getLayout()->createBlock('sk_measurements/adminhtml_profile_grid')
            ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /*public function wysiwygAction()
    {
        $elementId = $this->getRequest()->getParam('element_id', md5(microtime()));
        $storeId = $this->getRequest()->getParam('store_id', 0);
        $storeMediaUrl = Mage::app()->getStore($storeId)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);

        $content = $this->getLayout()->createBlock('easylife_news/adminhtml_news_helper_form_wysiwyg_content', '', array(
            'editor_element_id' => $elementId,
            'store_id' => $storeId,
            'store_media_url' => $storeMediaUrl,
        ));
        $this->getResponse()->setBody($content->toHtml());
    }*/
}