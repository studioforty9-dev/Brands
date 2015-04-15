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
 * Studioforty9_Brands_Block_Adminhtml_Grid_Renderer_Logo
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Block
 */
class Studioforty9_Brands_Block_Adminhtml_Grid_Renderer_Logo extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /** @const string */
    const MEDIA_FOLDER = 'brand';

    /**
     * Render the logo image.
     *
     * @param Varien_Object $row
     * @return string
     */
    public function render(Varien_Object $row)
    {
        $logoPath = $row->getLogoImage();
        $width = 100;
        $height = 75;

        if (empty($logoPath)) {
            $logo = $this->getSkinUrl() . 'images/placeholder/thumbnail.jpg';
        }
        else {
            $logo = $this->resize($logoPath, $width, $height);
        }

        return sprintf('<img src="%s" width="%s" height="%s" />',
            $logo, $width, $height
        );
    }

    /**
     * Resize the image.
     *
     * @param string $filename
     * @param int $width
     * @param int $height
     * @return string
     */
    protected function resize($filename, $width, $height)
    {
        $baseUrl  = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
        $basePath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA);
        $srcPath = $basePath . DS . self::MEDIA_FOLDER . DS . $filename;
        $newPath = $basePath . DS . self::MEDIA_FOLDER . DS . 'resized' . DS . $filename;

        $imageObj = new Varien_Image($srcPath);
        $imageObj->constrainOnly(false);
        $imageObj->keepAspectRatio(true);
        $imageObj->keepFrame(true);
        $imageObj->keepTransparency(true);
        $imageObj->resize($width, $height);
        $imageObj->save($newPath);

        return $baseUrl . self::MEDIA_FOLDER  . DS. 'resized' . DS . $filename;
    }
}
