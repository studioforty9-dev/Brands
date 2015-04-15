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
 * Studioforty9_Brands_Block_Adminhtml_Brand_Edit_Form
 *
 * @category   Studioforty9
 * @package    Studioforty9_Brands
 * @subpackage Block
 */
class Studioforty9_Brands_Block_Adminhtml_Brand_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare the edit form fields.
     *
     * @return $this
     * @access protected
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id'     => 'edit_form',
            'action' => $this->getUrl(
                '*/*/edit', array('_current' => true, 'continue' => 0)
            ),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset('general', array(
            'legend' => $this->__('Brand Details')
        ));
        $fieldset->addType('image', 'Studioforty9_Brands_Block_Adminhtml_Form_Image');
        $brandSingleton = Mage::getSingleton('studioforty9_brands/brand');

        $this->_addFieldsToFieldset($fieldset, array(
            'name' => array(
                'label' => $this->__('Name'),
                'input' => 'text',
                'required' => true,
            ),
            'url_key' => array(
                'label' => $this->__('URL Key'),
                'input' => 'text',
                'required' => true,
                'class' => 'validate-identifier'
            ),
            'description' => array(
                'label' => $this->__('Description'),
                'input' => 'textarea',
                'required' => true,
            ),
            'logo_image' => array(
                'label' => $this->__('Logo'),
                'input' => 'image',
                'required' => false,
            ),
            'visibility' => array(
                'label' => $this->__('Visibility'),
                'input' => 'select',
                'required' => true,
                'options' => $brandSingleton->getAvailableVisibilities(),
            )
        ));

        return $this;
    }

    /**
     * A simple helper method to add the fields to the fieldset.
     *
     * @param Varien_Data_Form_Element_Fieldset $fieldset
     * @param $fields
     * @return $this
     * @access protected
     */
    protected function _addFieldsToFieldset(Varien_Data_Form_Element_Fieldset $fieldset, $fields)
    {
        $requestData = new Varien_Object($this->getRequest()->getPost('brand'));
        foreach ($fields as $name => $_data) {
            if ($requestValue = $requestData->getData($name)) {
                $_data['value'] = $requestValue;
            }
            $_data['name'] = "brand[$name]";
            $_data['title'] = $_data['label'];
            if (!array_key_exists('value', $_data)) {
                $_data['value'] = $this->_getBrand()->getData($name);
            }
            $fieldset->addField($name, $_data['input'], $_data);
        }

        return $this;
    }

    /**
     * Get the brand model from the registry if possible, else get an
     * empty model instead.
     *
     * @return null|Studioforty9_Brands_Model_Brand
     * @access protected
     */
    protected function _getBrand()
    {
        if (! $this->hasData('brand')) {
            $brand = Mage::registry('current_brand');
            if (! $brand instanceof Studioforty9_Brands_Model_Brand) {
                $brand = Mage::getModel('studioforty9_brands/brand');
            }
            $this->setData('brand', $brand);
        }

        return $this->getData('brand');
    }

    /**
     * Get the url for the save and continue url.
     *
     * @return string
     */
    public function getSaveAndContinueUrl()
    {
        return $this->getUrl('*/*/save', array(
            '_current'   => true,
            'back'       => 'edit',
        ));
    }
}
