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
 * Studioforty9_Brands_Block_Brand
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Block
 */
class Studioforty9_Brands_Block_Brand extends Mage_Core_Block_Template
{
    /**
     * Set up the collection and pager block.
     *
     * @return void
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $collection = $this->getCollection();

        /** @var Mage_Page_Block_Html_Pager $pager */
        $pager = $this->getLayout()->createBlock('page/html_pager', 'studioforty9.brands.pager');
        $pager->setAvailableLimit($this->_getHelper()->getPerPageOptions());
        $pager->setCollection($collection);
        $this->setChild('pager', $pager);
    }

    /**
     * Set the collection.
     *
     * @return Studioforty9_Brands_Model_Resource_Brand_Collection
     */
    public function getCollection()
    {
        if (!$this->hasData('collection')) {
            $collection = Mage::getModel('studioforty9_brands/brand')
                ->getCollection()
                ->addFieldToFilter('visibility', array('eq' => '1'));
            $this->setData('collection', $collection);
        }
        
        return $this->getData('collection');
    }

    /**
     * Get the module data helper.
     *
     * @return Studioforty9_Brands_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('studioforty9_brands');
    }

    /**
     * Get the pagination html.
     *
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
