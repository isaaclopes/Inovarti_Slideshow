<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Slideshow_Block_Adminhtml_Slideshow_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {

        $model = Mage::registry('slideshow_slideshow');

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('slideshow_form', array('legend' => Mage::helper('slideshow')->__('Slide information')));

        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name' => 'stores[]',
                'label' => Mage::helper('slideshow')->__('Store View'),
                'title' => Mage::helper('slideshow')->__('Store View'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        }/*
          else {
          $fieldset->addField('store_id', 'hidden', array(
          'name'      => 'stores[]',
          'value'     => 0
          ));
          } */

        $fieldset->addField('slide_title', 'text', array(
            'label' => Mage::helper('slideshow')->__('Title'),
            'class'     => 'required-entry',
            'required' => true,
            'name' => 'slide_title',
        ));

        $fieldset->addField('slide_link', 'text', array(
            'label' => Mage::helper('slideshow')->__('Link'),
            'class'     => 'validate-url',
            'required' => true,
            'name' => 'slide_link',
        ));


        $data = array();
        $out = '';
        if (Mage::getSingleton('adminhtml/session')->getSlideshowData()) {
            $data = Mage::getSingleton('adminhtml/session')->getSlideshowData();
        } elseif (Mage::registry('slideshow_data')) {
            $data = Mage::registry('slideshow_data')->getData();
        }

        if (!empty($data['image'])) {
            $url = Mage::getBaseUrl('media') . $data['image'];
            $out = '<br/><center><a href="' . $url . '" target="_blank" id="imageurl">';
            $out .= "<img src=" . $url . " width='150px' />";
            $out .= '</a></center>';
        }

        $fieldset->addField('image', 'file', array(
            'label' => Mage::helper('slideshow')->__('Image'),
            'required' => false,
            'name' => 'image',
            'note' => 'Images Slider' . $out,
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('slideshow')->__('Status'),
            'name' => 'status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('slideshow')->__('Enabled'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('slideshow')->__('Disabled'),
                ),
            ),
        ));

        $fieldset->addField('sort_order', 'text', array(
            'label' => Mage::helper('slideshow')->__('Sort Order'),
            'required' => false,
            'name' => 'sort_order',
        ));

        if (Mage::getSingleton('adminhtml/session')->getSlideshowData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSlideshowData());
            Mage::getSingleton('adminhtml/session')->getSlideshowData(null);
        } elseif (Mage::registry('slideshow_data')) {
            $form->setValues(Mage::registry('slideshow_data')->getData());
        }
        return parent::_prepareForm();
    }

}