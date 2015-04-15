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
 * Studioforty9_Brands_IndexController
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Controller
 */
class Studioforty9_Brands_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * The index action displays a list/grid of brands.
     *
     * @return void
     */
    public function indexAction()
    {
        $this->loadLayout();
        
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        
        if ($headBlock = $this->getLayout()->getBlock('head')) {
            $headBlock->setTitle($this->_getHelper()->getSeoTitle());
            $headBlock->setKeywords($this->_getHelper()->getSeoKeywords());
            $headBlock->setDescription($this->_getHelper()->getSeoDescription());
        }
        
        $this->renderLayout();
    }

    /**
     * The list action displays a list/grid of products for the current brand.
     *
     * @return void
     */
    public function listAction()
    {
        if (! $urlKey = $this->getRequest()->get('url_key')) {
            return $this->norouteAction();
        }
        
        $this->loadLayout();
        
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');

        /** @var Mage_Page_Block_Html_Head $headBlock */
        if ($headBlock = $this->getLayout()->getBlock('head')) {
            $headBlock->setTitle($this->_getHelper()->getSeoTitle());
            $headBlock->setKeywords($this->_getHelper()->getSeoKeywords());
            $headBlock->setDescription($this->_getHelper()->getSeoDescription());
        }

        if ($this->_getHelper()->useBreadcrumbs()) {
            if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbsBlock->addCrumb(
                    'brand', array(
                    'label' => ucwords(str_replace('-', ' ', $urlKey))
                ));
            }
        }

        $this->renderLayout();
    }

    /**
     * Get the module data helper.
     *
     * @return Studioforty9_Brands_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('studioforty9_brands');
    }
}
