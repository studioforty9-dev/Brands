<?php
/**
 * Studioforty9 Brands
 *
 * @category  Studioforty9
 * @package   Studioforty9_Brands
 * @author    StudioForty9 <info@studioforty9.com>
 * @copyright 2015 StudioForty9 (http://www.studioforty9.com)
 * @license   https://github.com/studioforty9/brands/blob/master/LICENCE BSD
 * @version   1.0.0
 * @link      https://github.com/studioforty9/brands
 */

/**
 * Studioforty9_Brands_Block_Adminhtml_Brand_Edit
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Block
 */
class Studioforty9_Brands_Block_Adminhtml_Brand_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Set up the edit page actions.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_blockGroup = 'studioforty9_brands_adminhtml';
        $this->_controller = 'brand';
        $this->_mode = 'edit';
        $newOrEdit = $this->getRequest()->getParam('id')
            ? $this->__('Edit')
            : $this->__('New');

        $this->_headerText =  $newOrEdit . ' ' . $this->__('Brand');

        $this->_setupButtons();
    }

    /**
     * Set up the action buttons and supporting javascript.
     *
     * @return void
     */
    protected function _setupButtons()
    {
        $this->_addButton('save_and_continue', array(
            'label' => $this->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);
        $this->_updateButton('save', 'label', $this->__('Save'));

        $this->_addSaveAndContinueScript();
    }

    /**
     * Add the save and continue javascript functionality.
     *
     * @return $this
     */
    protected function _addSaveAndContinueScript()
    {
        $this->_formScripts[] = <<<JS
function saveAndContinueEdit() {
    editForm.submit($('edit_form').action+'back/edit/');
}
JS;
        return $this;
    }

    /**
     * Add the javascript functionality to toggle the wysiwyg editor.
     *
     * @return $this
     */
    protected function _addToggleScript()
    {
        $this->_formScripts[] = <<<JS
function toggleEditor() {
    if (tinyMCE.getInstanceById('form_content') == null) {
        tinyMCE.execCommand('mceAddControl', false, 'edit_form');
    } else {
        tinyMCE.execCommand('mceRemoveControl', false, 'edit_form');
    }
}
JS;
        return $this;
    }
}
