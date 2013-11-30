<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Slideshow_Block_Slideshow extends Mage_Core_Block_Template {

    public function _prepareLayout() {
        return parent::_prepareLayout();
    }

    public function getSlideshow() {
        if (!$this->hasData('slideshow')) {
            $this->setData('slideshow', Mage::registry('slideshow'));
        }
        return $this->getData('slideshow');
    }

    public function getSlides() {
        $slides = Mage::getModel('slideshow/slideshow')->getCollection()
                ->addStoreFilter(Mage::app()->getStore())
                ->addFieldToSelect('*')
                ->addFieldToFilter('status', 1)
                ->setOrder('sort_order', 'asc');
        return $slides;
    }

}