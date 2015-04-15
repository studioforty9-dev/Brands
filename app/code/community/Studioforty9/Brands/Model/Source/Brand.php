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
 * Studioforty9_Brands_Model_Source_Brand
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Model
 */
class Studioforty9_Brands_Model_Source_Brand extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    /**
     * Return an array of Brands ordered by `name`, keyed by `brand_id`
     *
     * @return array
     */
    public function getAllOptions()
    {
        $brandCollection = Mage::getModel('studioforty9_brands/brand')->getCollection()->setOrder('name', 'ASC');

        $options = array(
            array(
                'label' => '',
                'value' => '',
            ),
        );

        foreach ($brandCollection as $_brand) {
            $options[] = array(
                'label' => $_brand->getName(),
                'value' => $_brand->getId(),
            );
        }

        return $options;
    }
}
