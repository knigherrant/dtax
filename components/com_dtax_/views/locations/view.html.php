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
 * View class for a list of DTax.
 */
class DTaxViewLocations extends JViewLegacy {

<<<<<<< HEAD
        protected $state;
    protected $item;
    protected $form;
=======
    protected $items;
    protected $pagination;
    protected $state;
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9

    /**
     * Display the view
     */
    public function display($tpl = null) {
        $this->state = $this->get('State');
<<<<<<< HEAD
        $this->item = $this->get('Item');
        $this->form = $this->get('Form');
=======
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }
<<<<<<< HEAD
=======

>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
        parent::display($tpl);
    }

}
