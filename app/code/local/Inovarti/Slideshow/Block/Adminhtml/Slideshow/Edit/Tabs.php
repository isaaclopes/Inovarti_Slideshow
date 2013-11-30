<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Slideshow_Block_Adminhtml_Slideshow_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('slideshow_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('slideshow')->__('Slide Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('slideshow')->__('Slide Information'),
            'title' => Mage::helper('slideshow')->__('Slide Information'),
            'content' => $this->getLayout()->createBlock('slideshow/adminhtml_slideshow_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}