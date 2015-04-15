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
$installer = $this;
$installer->startSetup();
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$setup->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'brand_id', array(
    'group'                    => 'General',
    'type'                     => 'int',
    'input'                    => 'select',
    'label'                    => 'Brand',
    'global'                   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL, // or other scope
    'visible'                  => 1,
    'required'                 => 0,
    'visible_on_front'         => 1,
    'frontend_class'           => '',
    'is_html_allowed_on_front' => 0,
    'is_configurable'          => 0,
    'source'                   => 'studioforty9_brands/source_brand',
    'searchable'               => 1,
    'filterable'               => 1,
    'comparable'               => 1,
    'unique'                   => false,
    'user_defined'             => true,
    'is_user_defined'          => true,
    'used_in_product_listing'  => false,
    'default'                  => 0
));
$installer->endSetup();
