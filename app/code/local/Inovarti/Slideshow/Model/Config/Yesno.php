<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Slideshow_Model_Config_Yesno {

    
    public function toOptionArray()
    {
        return array(
            array('value' => 'true', 'label'=>Mage::helper('slideshow')->__('Yes')),
            array('value' => 'false', 'label'=>Mage::helper('slideshow')->__('No')),
        );
    }
}
