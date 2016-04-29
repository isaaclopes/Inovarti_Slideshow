<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Slideshow_Block_Adminhtml_Slideshow_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {

	$model = Mage::registry('current_model');
        
        
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('slideshow_form', array('legend' => Mage::helper('slideshow')->__('General Information')));
        if ($model->getId()) {
            $fieldset->addField('slideshow_id', 'hidden', array(
                'name'      => 'slideshow_id',
                'value'     => $model->getId(),
            ));
        }
        
        $fieldset->addField('is_active', 'select', array(
            'label'    => Mage::helper('slideshow')->__('Is Active'),
            'required' => true,
            'name'     => 'is_active',
            'value'    => $model->getIsActive(),
            'values'   => Mage::getSingleton('adminhtml/system_config_source_yesno')->toOptionArray(),
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'select', array(
                'label'    => Mage::helper('slideshow')->__('Store View'),
                'required' => true,
                'name'     => 'store_id',
                'value'    => $model->getStoreId(),
                'values'   => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(),
            ));
        } else {
            $fieldset->addField('store_id', 'hidden', array(
                'name'  => 'store_id',
                'value' => Mage::app()->getStore(true)->getId()
            ));
        }

        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('slideshow')->__('Title'),
            'class' => 'required-entry',
            'required' => true,
            'name'     => 'title',
            'value'    => $model->getTitle()
        ));

        $fieldset->addField('description', 'text', array(
            'label' => Mage::helper('slideshow')->__('Description'),
            'class' => 'required-entry',
            'required' => true,
            'name'     => 'description',
            'value'    => $model->getDescription()
        ));

        $fieldset->addField('link', 'text', array(
            'class' => 'validate-url',
            'label'    => Mage::helper('slideshow')->__('Link'),
            'required' => true,
            'name' => 'link',
            'value'    => $model->getLink(),
            'note'     => Mage::helper('slideshow')->__('e.g. http://')
        ));

        $fieldset->addField('position', 'select', array(
            'name'    => 'position',
            'label'    => Mage::helper('slideshow')->__('Position'),
            'required' => true,
            'value'    => $model->getPosition(),
            'values'   => Mage::getSingleton('slideshow/system_config_source_position')->toOptionArray(),
        ));
        $fieldset->addField('miniatura_mosaic', 'checkbox', array(
            'name'    => 'miniatura_mosaic',
            'label'    => Mage::helper('slideshow')->__('Miniatura Mosaico'),
            'after_element_html' => '<small>Sim</small>',
            'onclick' => 'this.value = this.checked ? 1 : 0;',
            'value'   => $model->getMiniaturaMosaic(),
        ))->setIsChecked($model->getMiniaturaMosaic());
        
        $fieldset->addField('from_date', 'date', array(
            'label' => Mage::helper('slideshow')->__('Date Start'),
            'name' => 'from_date',
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'format' => Mage::app()->getLocale()->getDateFormatWithLongYear(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
            'value'    => $model->getFromDate(),
        ));
        $fieldset->addField('to_date', 'date', array(
            'label' => Mage::helper('slideshow')->__('Date Expire'),
            'name' => 'to_date',
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'format' => Mage::app()->getLocale()->getDateFormatWithLongYear(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'input_format' => Varien_Date::DATE_INTERNAL_FORMAT,
            'value'    => $model->getToDate(),
        ));
        if($model->getId() && $model->getUrl()) {            
            $fieldset->addField('access_url', 'note', array(
                'label'    => Mage::helper('slideshow')->__('Slideshow Access Url'),
                'title'    => Mage::helper('slideshow')->__('Slideshow Access Url'),
                'text'    => '<a href="'.$model->getUrl().'" target="_blank">'.$model->getUrl().'</a>',
            ));

        }
        $out = '';
         if($model->getId() && $model->getImage()) {     
            $out = '<br/><center><a href="' . $model->getUrl() . '" target="_blank" id="imageurl">';
            $out .= "<img src=" . $model->getUrl() . " width='150px' />";
            $out .= '</a></center>';
        }

        $fieldset->addField('image', 'file', array(
            'label' => Mage::helper('slideshow')->__('Image'),
            'required' => false,
            'name' => 'image',
            'note' => 'Images Slider' . $out,
        ));
        
        $fieldset->addField('sort_order', 'text', array(
            'label' => Mage::helper('slideshow')->__('Ordem'),
            'required' => false,
            'name' => 'sort_order',
            'value'    => $model->getSortOrder(),
        ));
        return parent::_prepareForm();
    }

}