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

DROP TABLE IF EXISTS `{$this->getTable('slideshow/slideshow')}`;
CREATE TABLE `{$this->getTable('slideshow/slideshow')}` (
    `slideshow_id`          int(11)      NOT NULL AUTO_INCREMENT,
    `title`                 varchar(255) NOT NULL,
    `link`                  varchar(255) NOT NULL,
    `image`                 varchar(255) NOT NULL,
    `store`                 int(11)      NOT NULL DEFAULT '0',
    `store_id`              int(11)      NOT NULL DEFAULT '0',
    `sort_order`            smallint(6)  NOT NULL default '0',
    `position`              int(11)      NOT NULL DEFAULT '0',
    `is_active`             int(1)       NOT NULL DEFAULT '0',
    `from_date`             datetime     NULL,
    `to_date`               datetime     NULL,
    `created_at`            datetime     NOT NULL DEFAULT '0000-00-00 00:00:00',
    `updated_at`            datetime     NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`slideshow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('Slider 1', 'http://www.google.com.br', 'slide1.jpg', 1, 1, 1, NOW(), NOW(),4 );
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('Slider 2', 'http://www.google.com.br', 'slide1.jpg', 1, 2, 1, NOW(), NOW(),4 );
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('Slider 3', 'http://www.google.com.br', 'slide1.jpg', 1, 3, 1, NOW(), NOW(),4 );
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('Mini Slider 1', 'http://www.google.com.br', 'mini-banner-1.jpg', 1, 1, 2, NOW(), NOW(),4 );
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('Mini Slider 2', 'http://www.google.com.br', 'mini-banner-1.jpg', 1, 2, 2, NOW(), NOW(),4 );
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('Mini Slider 3', 'http://www.google.com.br', 'mini-banner-1.jpg', 1, 3, 2, NOW(), NOW(),4 );

    
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('carousel-1', 'http://www.google.com.br', 'carousel-1.jpg', 1, 1, 3, NOW(), NOW(),4 );
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('carousel-2', 'http://www.google.com.br', 'carousel-1.jpg', 1, 2, 3, NOW(), NOW(),4 );
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('carousel-3', 'http://www.google.com.br', 'carousel-1.jpg', 1, 3, 3, NOW(), NOW(),4 );
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('carousel-4', 'http://www.google.com.br', 'carousel-1.jpg', 1, 4, 3, NOW(), NOW(),4 );
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('carousel-5', 'http://www.google.com.br', 'carousel-1.jpg', 1, 5, 3, NOW(), NOW(),4 );
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('carousel-6', 'http://www.google.com.br', 'carousel-1.jpg', 1, 6, 3, NOW(), NOW(),4 );
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('carousel-7', 'http://www.google.com.br', 'carousel-1.jpg', 1, 7, 3, NOW(), NOW(),4 );
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('carousel-8', 'http://www.google.com.br', 'carousel-1.jpg', 1, 8, 3, NOW(), NOW(),4 );
INSERT INTO `{$this->getTable('slideshow/slideshow')}` (`title`, `link`, `image`, `is_active`, `sort_order`, `position`, `created_at`, `updated_at`, `store_id`) VALUES ('carousel-9', 'http://www.google.com.br', 'carousel-1.jpg', 1, 9, 3, NOW(), NOW(),4 );
                            
    


");
