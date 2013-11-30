<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Slideshow_Model_Config_Effect {

    /**
     * effects list
     *
     * @var string
     */
    private $effects = "slide,fade";

    public function toOptionArray() {
        $fonts = explode(',', $this->effects);
        $options = array();
        foreach ($fonts as $f) {
            $options[] = array(
                'value' => $f,
                'label' => $f,
            );
        }

        return $options;
    }

}
