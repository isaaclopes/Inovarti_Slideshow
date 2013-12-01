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
        ->addColumn($slidesTable, 'position', array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'length'    => 32,
            'nullable' => true,
            'default' => null)
);
$installer->run("
UPDATE `{$this->getTable('slideshow/slides')}` SET `position`='header';
");
$installer->endSetup();

