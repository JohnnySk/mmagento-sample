<?php

class Simple_SalesReport_Adminhtml_SalesreportController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Orders export form page
     */
    public function formAction()
    {
        $this->_title($this->__('Simple Sales Report Generation'));
        $this->loadLayout();
        $this->_setActiveMenu('sales');
        $this->renderLayout();
    }

    /**
     * Generates sales report according to date fields in request
     * Responses with CVS - file
     */
    public function downloadAction()
    {
        $postData = $this->getRequest()->getPost();
        $salesCsvReport = Mage::getModel('salesreport/csv');
        $fileName = $salesCsvReport->prepareSalesReport($postData);

        if ($fileName) {
            $this->_prepareDownloadResponse($fileName, file_get_contents($salesCsvReport->getExportDir() . '/' . $fileName));
        }
        else  {
           $this->_redirectReferer();
        }
    }


}