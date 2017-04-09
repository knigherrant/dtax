<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_DTax
 * @author     Joomlavi <info@joomlavi.com>
 * @copyright  2016 Joomlavi
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Class DTaxController
 *
 * @since  1.6
 */
class DTaxController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   mixed    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return   JController        This object to support chaining.
	 *
	 * @since    1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$vName   = $this->input->getCmd('view', 'frontend');
		$this->input->set('view', $vName);
		parent::display($cachable, $urlparams);

		return $this;
	}
        
        public function removeItem(){
            $input = JFactory::getApplication()->input;
            if(!JFactory::getUser()->id) die('Must login');
            if(($id = $input->getInt('id') ) && ($t = $input->getString('t'))){
                $table = "#__dtax_$t";
                JFactory::getDbo()->setQuery("DELETE FROM  $table WHERE id=$id")->execute();
                die('ok');
            }
            die('fail');
        }
}
