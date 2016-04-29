<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Slideshow_Block_Adminhtml_Slideshow_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('slideshow_grid');
        $this->setDefaultSort('slideshow_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('slideshow/slideshow')->getCollection();

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        
        $this->addColumn('slideshow_id', array(
            'header' => Mage::helper('slideshow')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'slideshow_id',
        ));

        $this->addColumn('title', array(
            'header' => Mage::helper('slideshow')->__('Title'),
            'align' => 'left',
            'index' => 'title',
        ));
        $this->addColumn('position', array(
            'header' => Mage::helper('slideshow')->__('Position'),
            'align' => 'left',
            'index' => 'position',
            'type' => 'options',
            'options' => Mage::getSingleton('slideshow/system_config_source_position')->toOptionArray()
        ));

        $this->addColumn('link', array(
            'header' => Mage::helper('slideshow')->__('Link'),
            'align' => 'left',
            'index' => 'link',
        ));
        $this->addColumn('image', array(
            'header' => Mage::helper('slideshow')->__('Image'),
            'align' => 'left',
            'width' => '100px',
            'index' => 'image',
            'renderer' => 'slideshow/adminhtml_slideshow_renderer_link'
        ));
        $this->addColumn('store_id', array(
            'header' => Mage::helper('slideshow')->__('Store'),
            'align' => 'left',
            'index' => 'store_id',
            'type' => 'store',
            'renderer' => 'Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Store'
        ));

        $this->addColumn('is_active', array(
            'header' => Mage::helper('slideshow')->__('Status'),
            'align' => 'left',
            'index' => 'is_active',
            'type' => 'options',
            'options' => array(
                1 => Mage::helper('slideshow')->__('Enabled'),
                0 => Mage::helper('slideshow')->__('Disabled'),
            ),
        ));
        $this->addColumn('action', array(
            'header' => Mage::helper('slideshow')->__('Action'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('slideshow')->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'id'
                ),
                array(
                    'caption' => Mage::helper('slideshow')->__('Remove'),
                    'url' => array('base' => '*/*/delete'),
                    'field' => 'id'
                ),
            ),
            'filter' => false,
            'sortable' => false,
            'is_system' => true,
            )
        );


        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
