<?php
/**
 * @version     1.0.0
 * @package     com_dtax
 * @copyright   Copyright (C) 2016 METIK Marketing, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Freddy Flores <fflores@metikmarketing.com> - https://www.metikmarketing.com
 */


// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_dtax')) 
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}
require_once JPATH_COMPONENT . '/helpers/dtax.php';
// Include dependancies

jimport('joomla.application.component.controller');
$controller	= JControllerLegacy::getInstance('DTax');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();

$dispatcher = JDispatcher::getInstance(); 
$dispatcher->register('onBeforeCompileHead','triggerScriptjQuery'); 
function triggerScriptjQuery(){ 
    $document = JFactory::getDocument(); 
    jSont::loadAdminCss(); 
} 