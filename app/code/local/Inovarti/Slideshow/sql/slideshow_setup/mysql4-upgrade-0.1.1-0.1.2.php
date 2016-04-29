<?php
/**
 *
 * @category   Inovarti
 * @package    Inovarti_SlideShow
 * @author     Suporte <suporte@inovarti.com.br>
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->getConnection()
    ->addColumn($installer->getTable('slideshow/slideshow'),
        'miniatura_mosaic', array(
            'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
            'nullable' => false,
            'default' => 0,
            'comment' => 'Miniatura Mosaic'
        ));
$installer->endSetup();