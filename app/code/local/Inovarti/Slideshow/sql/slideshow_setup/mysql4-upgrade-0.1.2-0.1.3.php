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
        ->addColumn($slidesTable, 'backgroundimage', array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'comment' => 'Background Image',
            'nullable' => true,
            'default' => null)
);

$installer->getConnection()
        ->addColumn($slidesTable, 'backgroundsize', array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'comment' => 'Background Size',
            'nullable' => true,
            'default' => null)
);

$installer->getConnection()
        ->addColumn($slidesTable, 'backgroundrepeat', array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'comment' => 'Background Repeat',
            'nullable' => true,
            'default' => null)
);

$installer->getConnection()
        ->addColumn($slidesTable, 'backgroundposition', array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'comment' => 'Background Position',
            'nullable' => true,
            'default' => null)
);
$installer->endSetup();

