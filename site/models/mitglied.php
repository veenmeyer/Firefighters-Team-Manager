<?php

/**
 * @version     1.0.0
 * @package     com_firefighters
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Ralf Meyer <ralf.meyer@mail.de> - https://einsatzkomponente.de
 */
// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modelitem');
jimport('joomla.event.dispatcher');

/**
 * Firefighters model.
 */
class FirefightersModelMitglied extends JModelItem {

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since	1.6
     */
    protected function populateState() {
        $app = JFactory::getApplication('com_firefighters');

        // Load state from the request userState on edit or from the passed variable on default
        if (JFactory::getApplication()->input->get('layout') == 'edit') {
            $id = JFactory::getApplication()->getUserState('com_firefighters.edit.mitglied.id');
        } else {
            $id = JFactory::getApplication()->input->get('id');
            JFactory::getApplication()->setUserState('com_firefighters.edit.mitglied.id', $id);
        }
        $this->setState('mitglied.id', $id);

        // Load the parameters.
        $params = $app->getParams();
        $params_array = $params->toArray();
        if (isset($params_array['item_id'])) {
            $this->setState('mitglied.id', $params_array['item_id']);
        }
        $this->setState('params', $params);
    }

    /**
     * Method to get an ojbect.
     *
     * @param	integer	The id of the object to get.
     *
     * @return	mixed	Object on success, false on failure.
     */
    public function &getData($id = null) {
        if ($this->_item === null) {
            $this->_item = false;

            if (empty($id)) {
                $id = $this->getState('mitglied.id');
            }

            // Get a level row instance.
            $table = $this->getTable();

            // Attempt to load the row.
            if ($table->load($id)) {
                // Check published state.
                if ($published = $this->getState('filter.published')) {
                    if ($table->state != $published) {
                        return $this->_item;
                    }
                }

                // Convert the JTable to a clean JObject.
                $properties = $table->getProperties(1);
                $this->_item = JArrayHelper::toObject($properties, 'JObject');
            } elseif ($error = $table->getError()) {
                $this->setError($error);
            }
        }

        

			if (isset($this->_item->dienstgrad) && $this->_item->dienstgrad != '') {
				if(is_object($this->_item->dienstgrad)){
					$this->_item->dienstgrad = JArrayHelper::fromObject($this->_item->dienstgrad);
				}
				$values = (is_array($this->_item->dienstgrad)) ? $this->_item->dienstgrad : explode(',',$this->_item->dienstgrad);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('name,bild')
							->from('`#__firefighters_dienstgrade`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->name;
						$this->_item->dienstgrad_image = $results->bild;
					}
				}

			$this->_item->dienstgrad = !empty($textValue) ? implode(', ', $textValue) : $this->_item->dienstgrad;

			}

			if (isset($this->_item->abteilungen) && $this->_item->abteilungen != '') {
				if(is_object($this->_item->abteilungen)){
					$this->_item->abteilungen = JArrayHelper::fromObject($this->_item->abteilungen);
				}
				$values = (is_array($this->_item->abteilungen)) ? $this->_item->abteilungen : explode(',',$this->_item->abteilungen);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('name')
							->from('`#__firefighters_abteilungen`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->name;
					}
				}

			$this->_item->abteilungen = !empty($textValue) ? implode(', ', $textValue) : $this->_item->abteilungen;

			}

			if (isset($this->_item->ausbildungen) && $this->_item->ausbildungen != '') {
				if(is_object($this->_item->ausbildungen)){
					$this->_item->ausbildungen = JArrayHelper::fromObject($this->_item->ausbildungen);
				}
				$values = (is_array($this->_item->ausbildungen)) ? $this->_item->ausbildungen : explode(',',$this->_item->ausbildungen);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('name')
							->from('`#__firefighters_ausbildungen`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->name;
					}
				}

			$this->_item->ausbildungen = !empty($textValue) ? implode(', ', $textValue) : $this->_item->ausbildungen;

			}

			if (isset($this->_item->missions_eiko) && $this->_item->missions_eiko != '') {
				if(is_object($this->_item->missions_eiko)){
					$this->_item->missions_eiko = JArrayHelper::fromObject($this->_item->missions_eiko);
				}
				$values = (is_array($this->_item->missions_eiko)) ? $this->_item->missions_eiko : explode(',',$this->_item->missions_eiko);

				$textValue = array();
				foreach ($values as $value){
					$db = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
							->select('datum_start')
							->from('`#__firefighters_termine`')
							->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query);
					$results = $db->loadObject();
					if ($results) {
						$textValue[] = $results->datum_start;
					}
				}

			$this->_item->missions_eiko = !empty($textValue) ? implode(', ', $textValue) : $this->_item->missions_eiko;

			}
		if ( isset($this->_item->created_by) ) {
			$this->_item->created_by_name = JFactory::getUser($this->_item->created_by)->name;
		}

        return $this->_item;
    }

    public function getTable($type = 'Mitglied', $prefix = 'FirefightersTable', $config = array()) {
        $this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR . '/tables');
        return JTable::getInstance($type, $prefix, $config);
    }

    /**
     * Method to check in an item.
     *
     * @param	integer		The id of the row to check out.
     * @return	boolean		True on success, false on failure.
     * @since	1.6
     */
    public function checkin($id = null) {
        // Get the id.
        $id = (!empty($id)) ? $id : (int) $this->getState('mitglied.id');

        if ($id) {

            // Initialise the table
            $table = $this->getTable();

            // Attempt to check the row in.
            if (method_exists($table, 'checkin')) {
                if (!$table->checkin($id)) {
                    $this->setError($table->getError());
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Method to check out an item for editing.
     *
     * @param	integer		The id of the row to check out.
     * @return	boolean		True on success, false on failure.
     * @since	1.6
     */
    public function checkout($id = null) {
        // Get the user id.
        $id = (!empty($id)) ? $id : (int) $this->getState('mitglied.id');

        if ($id) {

            // Initialise the table
            $table = $this->getTable();

            // Get the current user object.
            $user = JFactory::getUser();

            // Attempt to check the row out.
            if (method_exists($table, 'checkout')) {
                if (!$table->checkout($user->get('id'), $id)) {
                    $this->setError($table->getError());
                    return false;
                }
            }
        }

        return true;
    }

    public function getCategoryName($id) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query
                ->select('title')
                ->from('#__categories')
                ->where('id = ' . $id);
        $db->setQuery($query);
        return $db->loadObject();
    }

    public function publish($id, $state) {
        $table = $this->getTable();
        $table->load($id);
        $table->state = $state;
        return $table->store();
    }

    public function delete($id) {
        $table = $this->getTable();
        return $table->delete($id);
    }

}
