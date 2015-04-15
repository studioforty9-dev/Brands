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
 * Studioforty9_Brands_Model_Resource_Brand
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Model
 */
class Studioforty9_Brands_Model_Resource_Brand extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize the resource.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('studioforty9_brands/brand', 'entity_id');
    }
}
