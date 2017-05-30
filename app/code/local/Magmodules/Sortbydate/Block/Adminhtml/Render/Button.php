<?php
/**
 * Magmodules.eu - http://www.magmodules.eu
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@magmodules.eu so we can send you a copy immediately.
 *
 * @category      Magmodules
 * @package       Magmodules_Sortbydate
 * @author        Magmodules <info@magmodules.eu>
 * @copyright     Copyright (c) 2017 (http://www.magmodules.eu)
 * @license       http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Magmodules_Sortbydate_Block_Adminhtml_Render_Button extends Mage_Adminhtml_Block_System_Config_Form_Field
{

    /**
     * @param Varien_Data_Form_Element_Abstract $element
     *
     * @return mixed
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {

        $eavAttribute = new Mage_Eav_Model_Mysql4_Entity_Attribute();
        $attributeId = $eavAttribute->getIdByCode('catalog_product', 'created_at');

        if ($attributeId) {
            $attributeModel = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', 'created_at');
            $sort = $attributeModel['used_for_sort_by'];
            if ($sort) {
                $url = $this->getUrl('*/updatesort/index');
                $title = Mage::helper('sortbydate')->__('Remove as listing option');
            } else {
                $url = $this->getUrl('*/updatesort/index');
                $title = Mage::helper('sortbydate')->__('Add as listing option');
            }
        } else {
            $url = $this->getUrl('*/updatesort/index');
            $title = Mage::helper('sortbydate')->__('Add as listing option');
        }

        $this->setElement($element);
        $html = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setType('button')
            ->setClass('scalable')
            ->setLabel($title)
            ->setOnClick("setLocation('$url')")
            ->toHtml();

        return $html;
    }
}