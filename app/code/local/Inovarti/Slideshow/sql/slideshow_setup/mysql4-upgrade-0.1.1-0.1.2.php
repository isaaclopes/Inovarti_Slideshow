<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
$installer = $this;

$slidesTable = $installer->getTable('slideshow/slides');

$installer->startSetup();

$installer->getConnection()
        ->addColumn($slidesTable, 'color', array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'comment' => 'Color',
            'nullable' => true,
            'default' => null)
);
$installer->endSetup();

