<?php
/**
 * @version     1.0.0
 * @package     com_businesssystem
 * @copyright   Copyright (C) 2016 METIK Marketing, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Freddy Flores <fflores@metikmarketing.com> - https://www.metikmarketing.com
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Link controller class.
 */
class BusinessSystemControllerlink extends JControllerForm
{
    function __construct() {
        $this->view_list = 'links';
        $this->input = JFactory::getApplication()->input;
        parent::__construct();
    }

    public function download(){
        $id = $this->input->getInt('id');
        BusinessSystemHelper::downloadDoc($id);
    }
    

}