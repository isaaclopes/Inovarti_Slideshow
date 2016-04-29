<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Slideshow_Model_Slideshow extends Mage_Core_Model_Abstract {

    protected $_store = null;
    protected $_generator = null;

    protected function _construct() {
        $this->_init('slideshow/slideshow');
    }

    public function getStore() {
        if (!$this->_store) {
            $this->_store = Mage::app()->getStore($this->getStoreId())->getId();
        }
        return $this->_store;
    }

    public function getUrl() {
        if (file_exists(Mage::getBaseDir('media') . DS . 'slideshow' . DS . $this->getFilenameWithExt())) {
            return Mage::getBaseUrl('media') . 'slideshow/' . $this->getFilenameWithExt();
        }

        return false;
    }

    public function getFilenameWithExt() {
        $file = $this->getData('image');
        return $file;
    }

    public function getSlides($values) {

        $todayStartOfDayDate = Mage::app()->getLocale()->date()
                ->setTime('00:00:00')
                ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
        $todayEndOfDayDate = Mage::app()->getLocale()->date()
                ->setTime('23:59:59')
                ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
        $collection = Mage::getResourceModel('slideshow/slideshow_collection')
                ->addFieldToSelect(array('title', 'description', 'miniatura_mosaic', 'link', 'image'))
                ->addFieldToFilter('store_id', $this->getStore())
                ->addFieldToFilter('position', isset($values['position']) ? $values['position'] : 1)
                ->addFieldToFilter('is_active', 1)
                ->addFieldToFilter('from_date', array('or' => array(
                        0 => array('date' => true, 'to' => $todayEndOfDayDate),
                        1 => array('is' => new Zend_Db_Expr('null')))
                        ), 'left')
                ->addFieldToFilter('to_date', array('or' => array(
                0 => array('date' => true, 'from' => $todayStartOfDayDate),
                1 => array('is' => new Zend_Db_Expr('null')))
                ), 'left');
        $collection->getSelect()->order('sort_order', 'DESC');

        if (isset($values['limit'])) {
            $collection->setPageSize($values['limit'])->setCurPage(1)->load();
        }
        return $collection;
    }
}
