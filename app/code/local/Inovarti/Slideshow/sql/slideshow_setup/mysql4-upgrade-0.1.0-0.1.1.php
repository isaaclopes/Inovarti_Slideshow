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
        ->addColumn($slidesTable, 'from_date', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DATE,
            'comment' => 'From date',
            'nullable' => true,
            'default' => null)
);
$installer->getConnection()
        ->addColumn($slidesTable, 'to_date', array(
            'type' => Varien_Db_Ddl_Table::TYPE_DATE,
            'comment' => 'To date',
            'nullable' => true,
            'default' => null)
);
$installer->endSetup();

