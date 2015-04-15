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
 * Studioforty9_Brands_Adminhtml_BrandController
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Controller
 */
class Studioforty9_Brands_Adminhtml_BrandController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Set the title of the page.
     *
     * @return void
     */
    public function preDispatch()
    {
        parent::preDispatch();
        $this->_title($this->__('Manage Brands'));
    }
    

    /**
     * Add the grid block and display the grid page.
     *
     * @return void
     */
    public function indexAction()
    {
        $block = $this->getLayout()->createBlock('studioforty9_brands_adminhtml/brand');
        $this->loadLayout()->_addContent($block)->renderLayout();
    }

    /**
     * Prepare the edit page, save the details on post.
     *
     * @return void
     */
    public function editAction()
    {
        // Load the model
        $brand = Mage::getModel('studioforty9_brands/brand');
        if ($brandId = $this->getRequest()->getParam('id', false)) {
            $brand->load($brandId);
            if ($brand->getId() < 1) {
                $this->_getSession()->addError($this->__('The brand you requested does not exist.'));
                return $this->_redirect('*/*/index');
            }
        }

        if (!$this->getRequest()->isPost()) {
            Mage::register('current_brand', $brand);
            $this->loadLayout();
            $brandEditBlock = $this->getLayout()->createBlock(
                'studioforty9_brands_adminhtml/brand_edit'
            );
            $this->_addContent($brandEditBlock);
            return $this->renderLayout();
        }

        $data = $this->getRequest()->getPost('brand');

        // Handle image upload/delete
        $logoImage = array_key_exists('logo_image', $data) ? $data['logo_image'] : '';
        $upload = $this->_uploadImage($logoImage, 'logo_image');
        if ($upload === false) {
            unset($data['logo_image']);
        }
        else {
            $data['logo_image'] = $upload;
        }

        // Add the data to the model
        $brand->addData($data);

        // Attempt to save the model
        try {
            $brand->save();
            $this->_getSession()->addSuccess($this->__('The brand has been saved.'));
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        $page = $this->getRequest()->getParam('back', false);
        return $this->_redirect(
            '*/*/' . $page,
            array('id' => $brand->getId())
        );
    }

    /**
     * Delete a brand.
     *
     * @return void
     */
    public function deleteAction()
    {
        $brand = Mage::getModel('studioforty9_brands/brand');

        if ($brandId = $this->getRequest()->getParam('id', false)) {
            $brand->load($brandId);
        }

        if ($brand->getId() < 1) {
            $this->_getSession()->addError($this->__('The requested brand does not exist.'));
            return $this->_redirect('*/*/index');
        }

        try {
            $brand->delete();
            $this->_getSession()->addSuccess($this->__('The brand has been deleted.'));
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect('*/*/index');
    }

    /**
     * Return an instance of the brands data helper.
     *
     * @return Studioforty9_Brands_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('studioforty9_brands');
    }

    /**
     * Determine if the logged-in user has permission to access the
     * current route.
     *
     * @access protected
     * @return bool
     */
    protected function _isAllowed()
    {
        $actionName = $this->getRequest()->getActionName();
        switch ($actionName) {
            case 'index':
            case 'edit':
            case 'delete':
                // intentionally no break
            default:
                $adminSession = Mage::getSingleton('admin/session');
                $isAllowed = $adminSession
                    ->isAllowed('studioforty9_brands/brand');
                break;
        }

        return $isAllowed;
    }

    /**
     * Upload the image or delete the reference.
     *
     * @param array|string $imageData
     * @param string $fileName
     * @return bool|string
     */
    protected function _uploadImage($imageData, $fileName)
    {
        if (is_array($imageData) && isset($imageData['delete']) && (int) $imageData['delete'] === 1) {
            return '';
        }

        if (empty($_FILES)) {
            return false;
        }

        try {
            $uploader = new Varien_File_Uploader('brand[' . $fileName . ']');
            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
            $uploader->setAllowRenameFiles(false);
            $uploader->setFilesDispersion(false);
            $path = Mage::getBaseDir('media') . DS . 'brand' . DS;
            $uploader->save($path);
            return $uploader->getUploadedFileName();
        } catch (Exception $e) {
            Mage::log(sprintf(
              'Error while uploading the brand logo: (%s) %s',
              $e->getCode(),
              $e->getMessage()
          ));
        }

        return false;
    }
}
