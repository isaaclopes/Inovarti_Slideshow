<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Slideshow_Model_Mysql4_Slideshow_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('slideshow/slideshow');
    }

    /**
     * Add Filter by store
     *
     * @param Mage_Core_Model_Store $store
     * @param bool $withAdmin
     * @return Inovarti_Slideshow_Model_Mysql4_Slideshow_Collection
     */
    public function addStoreFilter($store, $withAdmin = true) {
        if ($store instanceof Mage_Core_Model_Store) {
            $store = array($store->getId());
        }

        $this->getSelect()->join(
                        array('store_table' => $this->getTable('slideshow/slides_store')), 'main_table.slide_id = store_table.slide_id', array()
                )
                ->where('store_table.store_id in (?)', ($withAdmin ? array(0, $store) : $store));

        return $this;
    }

}