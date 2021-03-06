<?php
/**
 * @version     1.0.0
 * @package     com_dtax
 * @copyright   Copyright (C) 2016 METIK Marketing, LLC. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Freddy Flores <fflores@metikmarketing.com> - https://www.metikmarketing.com
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of DTax records.
 */
class DTaxModelTaxreturns extends JModelList {

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'firstname', 'a.firstname',
                'midname', 'a.midname',
                'lastname', 'a.lastname',
                'phone', 'a.phone',
                'email', 'u.email',
                'company', 'a.company',
                'cpa', 'cpa',
                'account', 'a.account',
            );
        }

        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     */
    protected function populateState($ordering = null, $direction = null) {
        // Initialise variables.
        $app = JFactory::getApplication('administrator');

        // Load the filter state.
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        $published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
        $this->setState('filter.state', $published);

        

        // Load the parameters.
        $params = JComponentHelper::getParams('com_dtax');
        $this->setState('params', $params);

        // List state information.
        parent::populateState('a.id', 'desc');
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param	string		$id	A prefix for the store id.
     * @return	string		A store id.
     * @since	1.6
     */
    protected function getStoreId($id = '') {
        // Compile the store id.
        $id.= ':' . $this->getState('filter.search');
        $id.= ':' . $this->getState('filter.state');

        return parent::getStoreId($id);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
                $this->getState(
                        'list.select', 'DISTINCT a.*, CONCAT(a.tax_firstname, " " ,a.tax_midname, " " ,a.tax_lastname) as taxpayer '
                )
        );
        $query->from('`#__dtax_taxreturns` AS a');
        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
				$query->where('LOWER(a.tax_midname) LIKE ' . $search 
                                        . ' OR LOWER(a.tax_firstname) LIKE ' . $search
                                        . ' OR LOWER(a.tax_lastname) LIKE ' . $search
<<<<<<< HEAD
=======
                                        . ' OR LOWER(a.company) LIKE ' . $search
                                        . ' OR LOWER(a.cpa) LIKE ' . $search
                                         . ' OR LOWER(a.phone) LIKE ' . $search
                                         . ' OR LOWER(a.email) LIKE ' . $search
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
                                        );
            }
        }
     
<<<<<<< HEAD

=======
        $query->where('created_by = ' . JFactory::getUser()->id);
>>>>>>> 6da42b430d55062734b64ec082d4c7d1c81592e9
        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if ($orderCol && $orderDirn) {
            $query->order($db->escape($orderCol . ' ' . $orderDirn));
        }

        return $query;
    }

    public function getItems() {
        $items = parent::getItems();
        foreach ($items as $item){
            //$item->name = $item->firstname . ' ' .$item->midname . ' ' . $item->lastname;
        }
        return $items;
    }

}
