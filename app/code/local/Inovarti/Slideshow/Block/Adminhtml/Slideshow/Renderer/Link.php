<?php
/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */

class Inovarti_Slideshow_Block_Adminhtml_Slideshow_Renderer_Link extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $url = $row->getUrl();
        if ($url) {
            return '<a href="'.$url.'" target="_blank"><img src="'.$url.'" width="150px" /></a>';
        }
        
        return $row->getFilenameWithExt();
    }
}