<?php
/**
 *
 * @category   Inovarti
 * @package    Inovarti_SlideShow
 * @author     Suporte <suporte@inovarti.com.br>
 */

$installer = $this;
$connection = $installer->getConnection();
 
$installer->startSetup();
 
$installer->getConnection()
    ->addColumn($installer->getTable('slideshow/slideshow'),
    'description',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => true,
        'default' => null,
        'comment' => 'Description'
    )
);
 
$installer->endSetup();