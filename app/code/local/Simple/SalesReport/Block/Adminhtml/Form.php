<?php
class Simple_SalesReport_Block_Adminhtml_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Defines sales report generation form
     * @return object  Description
     */
    protected function _prepareForm()
    { 
        $form = new Varien_Data_Form(array(
            'id'        => 'sales-report-form',
            'action'    => $this->getUrl('adminhtml/salesreport/download'),
            'method'    => 'post',
        ));

        $form->addField('date_from', 'date', array(
            'name'      => 'date_from',
            'required'  => true,
            'label'     => $this->__('Date from'),
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'format'    => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT) ,
        ));

        $form->addField('date_to', 'date', array(
            'name'      => 'date_to',
            'label'     => $this->__('Date to'),
            'required'  => true,
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'format'    => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT) ,
            'value'     => date(Mage::app()->getLocale()->getDateStrFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
                                          strtotime('next weekday'))
        ));

        $form->addField('button', 'submit', array(
            'name'      => 'submit',
            'class'     => 'form-button',
            'value'     => $this->__('Get Report'),
        ));

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * Adds header text and validation script to the form
     * @param object $html Form's html
     */
    protected function _afterToHtml($html){
        return  '<h1>' . $this->__('Simple Sales Report Generation') . '</h1>' . 
                 $html . '<script>var salesReportForm = new varienForm(\'sales-report-form\');</script>';
    }
 }