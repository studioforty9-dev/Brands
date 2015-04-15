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
 * Studioforty9_Brands_Model_Brand
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Model
 */
class Studioforty9_Brands_Model_Brand extends Mage_Core_Model_Abstract
{
    const VISIBILITY_HIDDEN = '0';
    const VISIBILITY_DIRECTORY = '1';

    /**
     * Initialize the brand model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('studioforty9_brands/brand');
    }

    /**
     * Return an array of visibility options
     *
     * @return array
     */
    public function getAvailableVisibilities()
    {
        return array(
            self::VISIBILITY_HIDDEN => Mage::helper('studioforty9_brands')->__('Hidden'),
            self::VISIBILITY_DIRECTORY => Mage::helper('studioforty9_brands')->__('Visible'),
        );
    }

    /**
     * Get the url to the resized image.
     *
     * @param int $width
     * @param int $height
     * @param int $quality
     * @return string
     */
    public function getImageUrl($width, $height, $quality = 90)
    {
        $filename = $this->getLogoImage();
        
        if (empty($filename)) {
            return '';
        }
        
        $srcPath = Mage::getBaseDir() .'/media/brand/' . $filename;
        $newPath = Mage::getBaseDir() .'/media/brand/resized/' . $width .'x'. $height . '/' . $filename;
        
        $imageObj = new Varien_Image($srcPath);
        $imageObj->constrainOnly(false);
        $imageObj->keepAspectRatio(true);
        $imageObj->keepFrame(true);
        $imageObj->keepTransparency(true);
        $imageObj->quality($quality);
        $imageObj->resize($width, $height);
        $imageObj->save($newPath);
        
        return str_replace(Mage::getBaseDir(), trim(Mage::getBaseUrl(), '/'), $newPath);
    }

    /**
     * Get the url to the brand page by url_key.
     *
     * @return string
     */
    public function getUrl()
    {
        return Mage::getUrl('brands/' . $this->getUrlKey());
    }

    /**
     * Update timestamps and prepare the url key before the model is saved.
     *
     * @return $this
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();
        $this->_updateTimestamps();
        $this->_prepareUrlKey();

        return $this;
    }

    /**
     * Update timestamps.
     *
     * @return $this
     */
    protected function _updateTimestamps()
    {
        $timestamp = now();
        $this->setUpdatedAt($timestamp);

        if ($this->isObjectNew()) {
            $this->setCreatedAt($timestamp);
        }

        return $this;
    }

    /**
     * Prepare the slugified url key if the url key doesnt exist, check
     * that the new url key doesn't already exist.
     *
     * @return $this
     * @throws Mage_Adminhtml_Exception
     */
    protected function _prepareUrlKey()
    {
        $helper = Mage::helper('studioforty9_brands');

        $urlKey = $this->getUrlKey();
        if (empty($urlKey)) {
            $this->setUrlKey($helper->getSlug($this->getName()));
        }

        $count = $this->getCollection()
            ->addFieldToFilter('url_key', $this->getUrlKey())
            ->addFieldToFilter('entity_id', array('neq' => $this->getId()))
            ->count();

        if ($count > 0) {
            throw new Mage_Adminhtml_Exception($helper->__('Url Key is not unique.'));
        }

        return $this;
    }
}
