<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Slideshow_Model_Config_Yesno {

    public function toOptionArray() {
        $options = array();
        $options[] = array(
            'value' => 'true',
            'label' => 'Yes',
        );
        $options[] = array(
            'value' => 'false',
            'label' => 'No',
        );

        return $options;
    }

}
