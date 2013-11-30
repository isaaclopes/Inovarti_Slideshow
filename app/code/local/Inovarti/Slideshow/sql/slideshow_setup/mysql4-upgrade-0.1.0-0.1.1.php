<?php
/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */

$installer           = $this;
$connection          = $installer->getConnection();

$slidesTable          = $installer->getTable('slideshow/slides');

$installer->startSetup();



$connection->modifyColumn(
    $slidesTable,
    'from_date',
    array(
        'type'      => Varien_Db_Ddl_Table::TYPE_DATE,
        'nullable'  => true,
        'default'   => null
    )
);

$connection->modifyColumn(
    $slidesTable,
    'to_date',
    array(
        'type'      => Varien_Db_Ddl_Table::TYPE_DATE,
        'nullable'  => true,
        'default'   => null
    )
);

$installer->endSetup();

