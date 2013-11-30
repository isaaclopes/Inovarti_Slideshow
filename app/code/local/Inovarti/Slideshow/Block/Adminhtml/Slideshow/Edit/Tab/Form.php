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

        $fieldset->addField('slide_align', 'select', array(
            'label' => Mage::helper('slideshow')->__('Text Align'),
            'name' => 'slide_align',
            'values' => array(
                array(
                    'value' => 'left',
                    'label' => Mage::helper('slideshow')->__('Left'),
                ),
                array(
                    'value' => 'right',
                    'label' => Mage::helper('slideshow')->__('Right'),
                ),
                array(
                    'value' => 'center',
                    'label' => Mage::helper('slideshow')->__('Center'),
                ),
            ),
        ));

        $fieldset->addField('slide_title', 'text', array(
            'label' => Mage::helper('slideshow')->__('Title'),
            'required' => false,
            'name' => 'slide_title',
        ));
        $fieldset->addField('slide_text', 'textarea', array(
            'label' => Mage::helper('slideshow')->__('Text'),
            'required' => false,
            'name' => 'slide_text',
        ));
        $fieldset->addField('slide_button', 'text', array(
            'label' => Mage::helper('slideshow')->__('Button Text'),
            'required' => false,
            'name' => 'slide_button',
        ));
        $fieldset->addField('slide_width', 'text', array(
            'label' => Mage::helper('slideshow')->__('Content width'),
            'required' => false,
            'name' => 'slide_width',
        ));

        $fieldset->addField('slide_link', 'text', array(
            'label' => Mage::helper('slideshow')->__('Link'),
            'required' => false,
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
            'label' => Mage::helper('slideshow')->__('Image for PC'),
            'required' => false,
            'name' => 'image',
            'note' => 'Image used for PC screens (larger than 768) ' . $out,
        ));

        $out = '';
        if (!empty($data['small_image'])) {
            $url = Mage::getBaseUrl('media') . $data['small_image'];
            $out = '<br/><center><a href="' . $url . '" target="_blank" id="imageurl">';
            $out .= "<img src=" . $url . " width='150px' />";
            $out .= '</a></center>';
        }

        $fieldset->addField('small_image', 'file', array(
            'label' => Mage::helper('slideshow')->__('Small Image for iPhone'),
            'required' => false,
            'name' => 'small_image',
            'note' => 'Small image used for small screens (less than 768) ' . $out,
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