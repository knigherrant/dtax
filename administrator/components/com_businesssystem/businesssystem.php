<?php
/**
 * @version     1.0.0
 * @package     com_businesssystem
 * @copyright   Copyright (C) 2016 METIK Marketing, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Freddy Flores <fflores@metikmarketing.com> - https://www.metikmarketing.com
 */


// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_businesssystem')) 
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}
require_once JPATH_COMPONENT . '/helpers/businesssystem.php';
// Include dependancies

jimport('joomla.application.component.controller');
$controller	= JControllerLegacy::getInstance('BusinessSystem');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();