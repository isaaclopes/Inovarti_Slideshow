<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
$installer = $this;
$installer->startSetup();
$installer->run("

DROP TABLE IF EXISTS `{$this->getTable('slideshow/slides')}`;
CREATE TABLE `{$this->getTable('slideshow/slides')}` (
  `slide_id` int(11) unsigned NOT NULL auto_increment,
  `slide_title` text NOT NULL default '',
  `slide_link` varchar(255) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  `sort_order` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `{$this->getTable('slideshow/slides')}` (`slide_id`, `slide_title`, `slide_link`, `image`, `status`, `sort_order`, `created_time`, `update_time`) VALUES (1, 'Lorem Ipsum<br/> Dolor sit Amen', 'http://www.google.com.br', 'slideshow/slide1.jpg', 1, 10, NOW(), NOW() );
INSERT INTO `{$this->getTable('slideshow/slides')}` (`slide_id`, `slide_title`, `slide_link`, `image`, `status`, `sort_order`, `created_time`, `update_time`) VALUES (2, 'Lorem Ipsum Dolor sit Amen', 'http://www.google.com.br', 'slideshow/slide2.jpg', 1, 20, NOW(), NOW() );
INSERT INTO `{$this->getTable('slideshow/slides')}` (`slide_id`, `slide_title`, `slide_link`, `image`, `status`, `sort_order`, `created_time`, `update_time`) VALUES (3, 'Lorem Ipsum Dolor sit Amen', 'http://www.google.com.br', 'slideshow/slide3.jpg', 1, 30, NOW(), NOW() );

");

/**
 * Drop 'slides_store' table
 */
$conn = $installer->getConnection();
$conn->dropTable($installer->getTable('slideshow/slides_store'));

/**
 * Create table for stores
 */
$table = $installer->getConnection()
        ->newTable($installer->getTable('slideshow/slides_store'))
        ->addColumn('slide_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'nullable' => false,
            'primary' => true,
                ), 'Slide ID')
        ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
                ), 'Store ID')
        ->addIndex($installer->getIdxName('slideshow/slides_store', array('store_id')), array('store_id'))
        ->addForeignKey($installer->getFkName('slideshow/slides_store', 'slide_id', 'slideshow/slides', 'slide_id'), 'slide_id', $installer->getTable('slideshow/slides'), 'slide_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
        ->addForeignKey($installer->getFkName('slideshow/slides_store', 'store_id', 'core/store', 'store_id'), 'store_id', $installer->getTable('core/store'), 'store_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
        ->setComment('Slide To Store Linkage Table');
$installer->getConnection()->createTable($table);

/**
 * Assign 'all store views' to existing slides
 */
$installer->run("INSERT INTO {$this->getTable('slideshow/slides_store')} (`slide_id`, `store_id`) SELECT `slide_id`, 0 FROM {$this->getTable('slideshow/slides')};");
$installer->endSetup();