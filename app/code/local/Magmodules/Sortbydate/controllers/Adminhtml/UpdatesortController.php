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
 
class Magmodules_Sortbydate_Adminhtml_UpdatesortController extends Mage_Adminhtml_Controller_Action
{

    /**
     *
     */
    public function indexAction()
	{
		$eavAttribute = new Mage_Eav_Model_Mysql4_Entity_Attribute();
		$attributeId = $eavAttribute->getIdByCode('catalog_product', 'created_at');

		if($attributeId) {
			$attributeModel = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', 'created_at');	
			$sort = $attributeModel['used_for_sort_by'];
			if($sort) {
				$attributeModel->setUsedForSortBy(0);
				$attributeModel->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('sortbydate')->__('Sort by date has been removed as listing option'));
			} else {
				$attributeModel->setUsedForSortBy(1);
				$attributeModel->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('sortbydate')->__('Sort by date has been added to the listing options'));
			}		
		} else {
			Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('sortbydate')->__('Sort by date has been added to the listing options'));
		}
				
		$this->_redirect('adminhtml/system_config/edit/section/sortbydate');
	}

    /**
     * @return mixed
     */
    protected function _isAllowed()
    {
        return true;
    }
}