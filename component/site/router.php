<?php
/**
 * @package     Dummy.Frontend
 * @subpackage  dummy
 *
 * @copyright   Copyright (C) 2008 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

JLoader::import('dummy.library');

/**
 * Method for create query
 *
 * @param   array  &$query  A named array
 *
 * @return	array
 */
function dummyBuildRoute(&$query)
{
	$segments = array();

	// Get a menu item based on Itemid or currently active
	$app  = JFactory::getApplication();
	$menu = $app->getMenu();

	if (empty($query['Itemid']))
	{
		$menuItem = $menu->getActive();
	}
	else
	{
		$menuItem = $menu->getItem($query['Itemid']);
	}

	$mView	= (empty($menuItem->query['view'])) ? null : $menuItem->query['view'];
	$mId	= (empty($menuItem->query['id'])) ? null : $menuItem->query['id'];

	if (isset($query['view']))
	{
		$view = $query['view'];

		if (empty($query['Itemid']))
		{
			$segments[] = $query['view'];
		}

		unset($query['view']);
	}

	if (isset($view) && ($mView == $view) and (isset($query['id'])) and ($mId == intval($query['id'])))
	{
		unset($query['view']);
		unset($query['id']);
		unset($query['cid']);

		return $segments;
	}

	return $segments;
}

/**
 * Parse short link to full link
 *
 * @param   array  $segments  A named array
 *
 * @return  array  $vars
 */
function dummyParseRoute($segments)
{
	$vars = array();

	// Get the active menu item.
	$app  = JFactory::getApplication();
	$menu = $app->getMenu();
	$item = $menu->getActive();

	// Count route segments
	$count = count($segments);

	$vars['view'] = $segments[1];
	$vars['id']   = $segments[2];
	
	return $vars;
}
