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
 * Studioforty9_Brands_Block_Adminhtml_Brand
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Block
 */
class Studioforty9_Brands_Block_Adminhtml_Brand extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    /**
     * This is not a typical PHP constructor, it is called by the parent
     * constructor. Here we simply set the block group for the module and
     * tell the grid container to use the grid class under 'brand'.
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_blockGroup = 'studioforty9_brands_adminhtml';
        $this->_controller = 'brand';
        $this->_headerText = Mage::helper('studioforty9_brands')->__('Brands');
    }

    /**
     * Returns the create/edit url.
     *
     * @return string
     */
    public function getCreateUrl()
    {
        return $this->getUrl('*/*/edit');
    }
}
