<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Slideshow_Helper_Data extends Mage_Core_Helper_Abstract {
    public function isWritable($path)
    {
        $io = new Varien_Io_File();
        $io->cd($path);

        return $io->isWriteable($path);
    }
    public function getBasePath()
    {
        $dir = Mage::getBaseDir('media').DS.'slideshow';
        if (!file_exists($dir)) {
            mkdir($dir);
        }

        return $dir;
    }
}