<?php/** * @version     1.0.0 * @package     com_businesssystem * @copyright   Copyright (C) 2014. All rights reserved. * @license     GNU General Public License version 2 or later; see LICENSE.txt * @author      SonNguyen <info@phpkungfu.club> - http://www.phpkungfu.club */// No direct accessdefined('_JEXEC') or die;jimport('joomla.application.component.view');/** * View class for a list of BusinessSystem. */class BusinessSystemViewTemplates extends JViewLegacy{	protected $items;	protected $pagination;	protected $state;	/**	 * Display the view	 */	public function display($tpl = null)	{		$this->state		= $this->get('State');		$this->items		= $this->get('Items');		$this->pagination	= $this->get('Pagination');		// Check for errors.		if (count($errors = $this->get('Errors'))) {			throw new Exception(implode("\n", $errors));		}        		BusinessSystemHelper::addSubmenu('templates');		$this->addToolbar();            $this->sidebar = JHtmlSidebar::render();       		parent::display($tpl);	}	/**	 * Add the page title and toolbar.	 *	 * @since	1.6	 */	protected function addToolbar()	{		$state	= $this->get('State');		$canDo	= BusinessSystemHelper::getActions($state->get('filter.category_id'));		    JToolBarHelper::title(JText::_('Templates'), 'file');               //JToolBarHelper::custom('templates.export', 'export.png', 'export.png', 'Export', false);        //Check if the form exists before showing the add/edit buttons        $formPath = JPATH_COMPONENT_ADMINISTRATOR.'/views/template';        if (file_exists($formPath)) {            if ($canDo->get('core.create')) {			    JToolBarHelper::addNew('template.add','JTOOLBAR_NEW');		    }		    if ($canDo->get('core.edit') && isset($this->items[0])) {			    JToolBarHelper::editList('template.edit','JTOOLBAR_EDIT');		    }        }		if ($canDo->get('core.edit.state')) {            if (isset($this->items[0]->state)) {                            			    JToolBarHelper::divider();			    JToolBarHelper::custom('templates.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);			    JToolBarHelper::custom('templates.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);            }            if (isset($this->items[0])) {                JToolBarHelper::deleteList('', 'templates.delete','JTOOLBAR_DELETE');            }            if (isset($this->items[0]->checked_out)) {            	JToolBarHelper::custom('templates.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);            }		}            $this->f_state = jSont::getPublishedOptions();            $this->f_category = jSont::getCategoryOptions();            JHtmlSidebar::addFilter(                JText::_('JOPTION_SELECT_CATEGORY'),                'filter_category',                JHtml::_('select.options', jSont::getCategoryOptions(), "value", "text", $this->state->get('filter.category'), true)            );	}    	protected function getSortFields()	{		return array(            'a.state' => JText::_('JSTATUS'),            'a.title' => JText::_('COM_SIGGLOACCMGR_TITLE'),            'access_title' => JText::_('COM_SIGGLOACCMGR_ACCESS'),            'cat_title' => JText::_('Category'),            'created_by_name' => JText::_('COM_SIGGLOACCMGR_OWNER'),            'a.created' => JText::_('COM_SIGGLOACCMGR_CREATED'),            'a.id' => JText::_('JGRID_HEADING_ID'),        );	}    }