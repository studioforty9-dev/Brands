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

$table = new Varien_Db_Ddl_Table();

$table->setName($this->getTable('studioforty9_brands/brand'));

$table->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 10, array(
    'auto_increment' => true,
    'unsigned'       => true,
    'nullable'       => false,
    'primary'        => true
));
$table->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
    'nullable' => false,
));
$table->addColumn('url_key', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
    'nullable' => false,
));
$table->addColumn('logo_image', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
    'nullable' => false,
));
$table->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
    'nullable' => false,
));
$table->addColumn('visibility', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, array(
    'nullable' => false,
));
$table->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    'nullable' => false,
));
$table->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
    'nullable' => false,
));
$table->addIndex(
    $installer->getIdxName('studioforty9_brands/brand', array('url_key'),
    Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE), 'url_key',
    array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE)
);
/**
 * These two important lines are often missed.
 */
$table->setOption('type', 'InnoDB');
$table->setOption('charset', 'utf8');

/**
 * Create the table!
 */
$installer->getConnection()->createTable($table);

$installer->endSetup();
