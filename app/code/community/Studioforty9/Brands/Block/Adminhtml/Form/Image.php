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
 * Studioforty9_Brands_Block_Adminhtml_Media_Helper_Image
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Block
 */
class Studioforty9_Brands_Block_Adminhtml_Form_Image extends Varien_Data_Form_Element_Image
{
    /**
     * _getUrl()
     *
     * @return bool|string
     */
    protected function _getUrl()
    {
        $url = false;
        $value = parent::_getUrl();

        if (is_array($value)) {
            $value = $value['value'];
        }

        if (empty($value)) {
            return $url;
        }


        $path = 'brand/resized/' . $value;
        if (file_exists(Mage::getBaseDir('media') . '/'. $path)) {
            return Mage::getBaseUrl('media') . $path;
        }

        $path = 'brand/' . $value;
        if (file_exists(Mage::getBaseDir('media') . '/'. $path)) {
            return Mage::getBaseUrl('media') . $path;
        }

        return $url;
    }

    /**
     * Return element html code
     *
     * @return string
     */
    public function getElementHtml()
    {
        $html = parent::getElementHtml();

        $search = 'height="22" width="22"';
        $replace = 'height="75" width="100"';

        if (strpos($html, $search)) {
            $html = str_replace($search, $replace, $html);
        }

        return $html;
    }
}
