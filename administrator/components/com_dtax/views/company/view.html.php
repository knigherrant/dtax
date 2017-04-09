<?php
/**
 * @version     1.0.0
 * @package     com_dtax
 * @copyright   Copyright (C) 2016 METIK Marketing, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Freddy Flores <fflores@metikmarketing.com> - https://www.metikmarketing.com
 */
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View to edit
 */
class DTaxViewCompany extends JViewLegacy {

    protected $state;
    protected $item;
    protected $form;
     protected $items;

    /**
     * Display the view
     */
    public function display($tpl = null) {
        $this->state = $this->get('State');
        $this->item = $this->get('Item');
        $this->form = $this->get('Form');
        $this->items = $this->get('Locations');
        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }

        $this->addToolbar();
        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     */
    protected function addToolbar() {
        JFactory::getApplication()->input->set('hidemainmenu', true);

        $user = JFactory::getUser();
        $isNew = ($this->item->id == 0);
        if (isset($this->item->checked_out)) {
            $checkedOut = !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
        } else {
            $checkedOut = false;
        }
        $canDo = DTaxHelper::getActions();

        JToolBarHelper::title(JText::_('Company'), 'user');
        $layout = $this->getLayout();
		if($this->getLayout() =='view') return;
        // If not checked out, can save the item.
        if($layout == 'edit'){
            if (!$checkedOut && ($canDo->get('core.edit') || ($canDo->get('core.create')))) {

                JToolBarHelper::apply('company.apply', 'JTOOLBAR_APPLY');
                JToolBarHelper::save('company.save', 'JTOOLBAR_SAVE');
            }
        }

        if (empty($this->item->id)) {
            JToolBarHelper::cancel('company.cancel', 'JTOOLBAR_CANCEL');
        } else {
            JToolBarHelper::cancel('company.cancel', 'JTOOLBAR_CLOSE');
        }
    }

}
