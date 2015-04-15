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
 * Studioforty9_Brands_Helper_Product
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Helper
 */
class Studioforty9_Brands_Helper_Product extends Mage_Core_Helper_Abstract
{
    /**
     * Find products by Brand Id.
     *
     * @param int $brandId
     * @return Mage_Catalog_Model_Resource_Product_Collection
     */
    public function findByBrandId($brandId)
    {
        $products = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addPriceData()
            ->addTaxPercents()
            ->addUrlRewrite()
            ->joinTable(
                'studioforty9_brands/brand',
                'entity_id=entity_id',
                array('brand_name' => 'name', 'brand_image' => 'logo_image'),
                '(studioforty9_brands.visibility=1 AND studioforty9_brands.entity_id=' . $brandId . ')',
                'left'
            )
            ->addStoreFilter();
                
        return $products;
    }
    
    /**
     * Find products by Brand Url Key.
     *
     * @param string $urlKey
     * @return Mage_Catalog_Model_Resource_Product_Collection
     */
    public function findByUrlKey($urlKey)
    {
        $products = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addPriceData()
            ->addTaxPercents()
            ->addUrlRewrite()
            ->joinTable(
                'studioforty9_brands/brand',
                'entity_id=entity_id',
                array('brand_name' => 'name', 'brand_image' => 'logo_image'),
                '(studioforty9_brands.visibility=1 AND studioforty9_brands.url_key="' . $urlKey . '")',
                'left'
            )
            ->addStoreFilter();
                
        return $products;
    }
    
    /**
     * Find all products and attach brand information.
     *
     * @return Mage_Catalog_Model_Resource_Product_Collection
     */
    public function findAll()
    {
        $products = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addPriceData()
            ->addTaxPercents()
            ->addUrlRewrite()
            ->joinTable(
                'studioforty9_brands/brand',
                'entity_id=entity_id',
                array('brand_name' => 'name', 'brand_image' => 'logo_image'),
                'studioforty9_brands.visibility=1',
                'left'
            )
            ->addStoreFilter();
                
        return $products;
    }
}
