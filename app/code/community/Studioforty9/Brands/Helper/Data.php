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
 * Studioforty9_Brands_Helper_Data
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Helper
 */
class Studioforty9_Brands_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Get the url to the brands page.
     *
     * @return string
     */
    public function getBrandUrl()
    {
        return Mage::getUrl('brands');
    }

    /**
     * Get the brand page link label.
     *
     * @return string
     */
    public function getBrandName()
    {
        $label = Mage::getStoreConfig('studioforty9_brands/default/link');
        return (empty($label)) ? $this->__('Brands') : $label;
    }

    /**
     * Determine if we should use breadcrumbs.
     *
     * @return bool
     */
    public function useBreadcrumbs()
    {
        return Mage::getStoreConfigFlag('studioforty9_brands/default/breadcrumbs');
    }

    /**
     * Get the default seo title.
     *
     * @return string
     */
    public function getSeoTitle()
    {
        return Mage::getStoreConfig('studioforty9_brands/seo/title');
    }

    /**
     * Get the default seo keywords.
     *
     * @return string
     */
    public function getSeoKeywords()
    {
        return Mage::getStoreConfig('studioforty9_brands/seo/keywords');
    }

    /**
     * Get the default seo description.
     *
     * @return string
     */
    public function getSeoDescription()
    {
        return Mage::getStoreConfig('studioforty9_brands/seo/description');
    }

    /**
     * Determine if we should add a link to the top.links block.
     *
     * @return bool
     */
    public function useLink()
    {
        return Mage::getStoreConfigFlag('studioforty9_brands/default/uselink');
    }

    /**
     * Get the options for the dropdown for show x brands per page.
     *
     * @return array
     */
    public function getPerPageOptions()
    {
        $perpage = Mage::getStoreConfig('studioforty9_brands/brand/perpage');
        $options = array();

        foreach (explode(',', $perpage) as $num) {
            $options[$num] = $num;
        }

        return $options;
    }

    /**
     * Return a slugified string based on the $str parameter.
     *
     * @todo Write a test to verify the return value here.
     * @param string $str
     * @param string $separator
     * @return string
     */
    public function getSlug($str, $separator = '-')
    {
        $str = (string) strtolower($str);
        $str = Mage::helper('core')->removeAccents($str);
        $urlKey = preg_replace('/[^0-9a-z]+/i', $separator, $str);
        $urlKey = trim($urlKey, $separator);
        return $urlKey;
    }
}
