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
 * Studioforty9_Brands_Block_Brand_List
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Block
 */
class Studioforty9_Brands_Block_Brand_List extends Mage_Catalog_Block_Product_List
{
    /**
     * If the current request has a url key in the query parameters, find
     * all products for that brand.
     *
     * @return void
     */
    protected function _construct()
    {
        $urlKey = Mage::app()->getRequest()->get('url_key');
        $this->_productCollection = Mage::helper('studioforty9_brands/product')->findByUrlKey($urlKey);
    }
}
