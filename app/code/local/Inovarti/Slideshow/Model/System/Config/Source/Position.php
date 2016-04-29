<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Slideshow_Model_System_Config_Source_Position {

    public function toOptionArray() {

        return array(
            1 =>Mage::helper('slideshow')->__('Banner'),
            6 =>Mage::helper('slideshow')->__('Banner Lateral'),
            7 =>Mage::helper('slideshow')->__('Mini Banner Rotativo'),
            2 =>Mage::helper('slideshow')->__('Mini Banner'),
            3 =>Mage::helper('slideshow')->__('Carrosel'),
            4 =>Mage::helper('slideshow')->__('Banner Fix (topo mini)'),
            5 =>Mage::helper('slideshow')->__('Banner Mobile'),
            8 =>Mage::helper('slideshow')->__('Banner Mosaic (esquerda)'),
            9 =>Mage::helper('slideshow')->__('Banner Mosaic (direita)'),
        );
    }

}