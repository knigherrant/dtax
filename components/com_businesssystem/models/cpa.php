<?php
/**
 * @version     1.0.0
 * @package     com_businesssystem
 * @copyright   Copyright (C) 2016 METIK Marketing, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Freddy Flores <fflores@metikmarketing.com> - https://www.metikmarketing.com
 */
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

/**
 * BusinessSystem model.
 */
class BusinessSystemModelBDS extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_BUSINESSSYSTEM';


	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'BDS', $prefix = 'BusinessSystemTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app	= JFactory::getApplication();
                JForm::addFormPath(JPATH_COMPONENT_ADMINISTRATOR . '/models/forms');
		JForm::addFieldPath(JPATH_COMPONENT_ADMINISTRATOR . '/models/fields');
		// Get the form.
		$form = $this->loadForm('com_businesssystem.cpa', 'cpa', array('control' => 'jform', 'load_data' => $loadData));
        
        
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_businesssystem.edit.cpa.data', array());

		if (empty($data)) {
			$data = $this->getItem();
            
		}

		return $data;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param	integer	The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * @since	1.6
	 */
	public function getItem($pk = null)
	{
                $cpa = JST::isBDS();
                if(!$pk) $pk = $cpa->id;
		if ($item = parent::getItem($pk)) {
                        $item->user = JFactory::getUser($item->userid);
		}

		return $item;
	}

        
        
        function save($data) {
            
            if(isset($_FILES['jform']['name'])){
                foreach ($_FILES['jform']['name'] as $f=>$file){
                    if($file){
                        jimport('joomla.filesystem.folder');
                        jimport('joomla.filesystem.file');
                        $path = 'images/businesssystem/';
                        if(!JFolder::exists(JPATH_ROOT . '/' .$path)) JFolder::create (JPATH_ROOT . '/' . $path);
                        $filepath = $path . time() . '_' . $file;
                        if(JFile::upload($_FILES['jform']['tmp_name'][$f], JPATH_ROOT .'/'. $filepath)){
                            $data[$f] = $filepath;
                        }
                    }
                }
            }
            return parent::save($data);
        }

}