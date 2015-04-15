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
 * Studioforty9_Brands_Block_Adminhtml_Brand_Grid
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Block
 */
class Studioforty9_Brands_Block_Adminhtml_Brand_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Prepare the collection of brand models to pass to the grid.
     *
     * @access protected
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('studioforty9_brands/brand_collection');
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Return the edit url for each row.
     *
     * @param object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $row->getId()
        ));
    }

    /**
     * Prepare the columns to use in the grid.
     *
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header' => $this->_getHelper()->__('ID'),
            'type'   => 'number',
            'index'  => 'entity_id',
        ));
        $this->addColumn('logo_image', array(
            'header'   => $this->_getHelper()->__('Logo'),
            'type'     => 'image',
            'index'    => 'logo_image',
            'renderer' => new Studioforty9_Brands_Block_Adminhtml_Grid_Renderer_Logo(),
            'width'    => '100px',
            'align'    => 'center',
            'escape'   => true,
            'sortable' => false,
            'filter'   => false
        ));
        $this->addColumn('name', array(
            'header' => $this->_getHelper()->__('Name'),
            'type'   => 'text',
            'index'  => 'name',
        ));
        $this->addColumn('url_key', array(
            'header' => $this->_getHelper()->__('Url Key'),
            'type'   => 'text',
            'index'  => 'url_key',
        ));
        $brandSingleton = Mage::getSingleton('studioforty9_brands/brand');
        $this->addColumn('visibility', array(
            'header'  => $this->_getHelper()->__('Visibility'),
            'type'    => 'options',
            'index'   => 'visibility',
            'options' => $brandSingleton->getAvailableVisibilities()
        ));
        $this->addColumn('created_at', array(
            'header' => $this->_getHelper()->__('Created'),
            'type'   => 'datetime',
            'index'  => 'created_at',
        ));
        $this->addColumn('updated_at', array(
            'header' => $this->_getHelper()->__('Updated'),
            'type'   => 'datetime',
            'index'  => 'updated_at',
        ));
        $this->addColumn('action', array(
            'header'   => $this->_getHelper()->__('Action'),
            'width'    => '50px',
            'type'     => 'action',
            'actions'  => array(
                array(
                    'caption' => $this->_getHelper()->__('Edit'),
                    'url'     => array('base' => '*/*/edit'),
                    'field'   => 'id'
                ),
            ),
            'filter'   => false,
            'sortable' => false,
            'index'    => 'entity_id',
        ));

        return parent::_prepareColumns();
    }

    /**
     * Get the brands data helper.
     *
     * @return Studioforty9_Brands_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('studioforty9_brands');
    }
}
