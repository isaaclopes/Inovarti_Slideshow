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
        $todayStartOfDayDate = Mage::app()->getLocale()->date()
                ->setTime('00:00:00')
                ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

        $todayEndOfDayDate = Mage::app()->getLocale()->date()
                ->setTime('23:59:59')
                ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

        $slides = Mage::getModel('slideshow/slideshow')->getCollection()
                ->addStoreFilter(Mage::app()->getStore())
                ->addFieldToSelect('*')
                ->addFieldToFilter('status', 1)
                ->setOrder('sort_order', 'asc');

        $slides
                ->addFieldToFilter('from_date', array('or' => array(
                        0 => array('date' => true, 'to' => $todayEndOfDayDate),
                        1 => array('is' => new Zend_Db_Expr('null')))
                        ), 'left')
                ->addFieldToFilter('to_date', array('or' => array(
                        0 => array('date' => true, 'from' => $todayStartOfDayDate),
                        1 => array('is' => new Zend_Db_Expr('null')))
                        ), 'left');
        return $slides;
    }

}