<?php
/**
 * @package     Dummy.Backend
 * @subpackage  View
 *
 * @copyright   Copyright (C) 2008 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

/**
 * Object edit view
 *
 * @package     Dummy.Backend
 * @subpackage  View
 * @since       0.9.1
 */
class DummyViewObject extends DummyView
{
	/**
	 * @var  boolean
	 */
	protected $displaySidebar = false;

	/**
	 * Display the category edit page
	 *
	 * @param   string  $tpl  The template file to use
	 *
	 * @return   string
	 *
	 * @todo Check the extra fields once implemented
	 *
	 * @since   0.9.1
	 */
	public function display($tpl = null)
	{
		$app = JFactory::getApplication();
		JFactory::getLanguage()->load('', JPATH_ADMINISTRATOR);

		$this->item = $this->get('Item');
		$this->form     = $this->get('Form');

		// Display the template
		parent::display($tpl);
	}

	/**
	 * Get the view title.
	 *
	 * @return  string  The view title.
	 */
	public function getTitle()
	{
		$subTitle = ' <small>' . JText::_('COM_DUMMY_NEW') . '</small>';

		if ($this->item->id)
		{
			$subTitle = ' <small>' . JText::_('COM_DUMMY_EDIT') . '</small>';
		}

		return JText::_('COM_DUMMY_OBJECT_ITEM') . $subTitle;
	}

	/**
	 * Get the toolbar to render.
	 *
	 * @todo	We have setup ACL requirements for Dummy
	 *
	 * @return  RToolbar
	 */
	public function getToolbar()
	{
		$group1 = new RToolbarButtonGroup;

		$save = RToolbarBuilder::createSaveButton('object.apply');
		$saveAndClose = RToolbarBuilder::createSaveAndCloseButton('object.save');
		$saveAndNew = RToolbarBuilder::createSaveAndNewButton('object.save2new');
		$group1->addButton($save);
		$group2 = new RToolbarButtonGroup;
		$group2->addButton($saveAndClose);
		$group3 = new RToolbarButtonGroup;
		$group3->addButton($saveAndNew);

		if (empty($this->item->id))
		{
			$cancel = RToolbarBuilder::createCancelButton('object.cancel');
		}
		else
		{
			$cancel = RToolbarBuilder::createCloseButton('object.cancel');
		}
		$group5 = new RToolbarButtonGroup;
		$group5->addButton($cancel);

		$toolbar = new RToolbar;
		$toolbar->addGroup($group1)
			->addGroup($group2)
			->addGroup($group3)
			->addGroup($group5);

		return $toolbar;
	}
}
