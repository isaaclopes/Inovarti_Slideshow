<?php
/**
 *
 * @category   Inovarti
 * @package    Inovarti_Slideshow
 * @author     Suporte <suporte@inovarti.com.br>
 */

class Inovarti_Slideshow_Block_Adminhtml_Slideshow_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'slideshow';
        $this->_controller = 'adminhtml_slideshow';

        $this->_updateButton('save', 'label', Mage::helper('slideshow')->__('Save Slide'));
        $this->_updateButton('delete', 'label', Mage::helper('slideshow')->__('Delete Slide'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action + 'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('current_model')->getId() > 0) {
            return Mage::helper('slideshow')->__("Edit Slideshow '%s'", $this->htmlEscape(Mage::registry('current_model')->getTitle()));
        } else {
            return Mage::helper('slideshow')->__('Add Slideshow');
        }
    }
}