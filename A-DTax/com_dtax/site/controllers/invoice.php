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

jimport('joomla.application.component.controllerform');

/**
 * Invoice controller class.
 */
class DTaxControllerInvoice extends JControllerForm
{
    function __construct() {
        $this->view_list = 'invoices';
        $this->input = JFactory::getApplication()->input;
        parent::__construct();
    }

    public function download(){
        $id = $this->input->getInt('id');
        DTaxHelper::downloadDoc($id);
    }
}