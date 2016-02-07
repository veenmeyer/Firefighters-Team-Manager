<?php

/**
 * @version     1.0.0
 * @package     com_firefighters
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Ralf Meyer <ralf.meyer@mail.de> - http://einsatzkomponente.de
 */
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of Firefighters.
 */
class FirefightersViewMitglieder extends JViewLegacy {

    protected $items;
    protected $pagination;
    protected $state;

    /**
     * Display the view
     */
    public function display($tpl = null) {
        $this->state = $this->get('State');
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');


        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }

        FirefightersHelper::addSubmenu('mitglieder');

        $this->addToolbar();

        $this->sidebar = JHtmlSidebar::render();
        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @since	1.6
     */
    protected function addToolbar() {
        require_once JPATH_COMPONENT . '/helpers/firefighters.php';

        $state = $this->get('State');
        $canDo = FirefightersHelper::getActions($state->get('filter.category_id'));

        JToolBarHelper::title(JText::_('COM_FIREFIGHTERS_TITLE_MITGLIEDER'), 'mitglieder.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/mitglied';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
                JToolBarHelper::addNew('mitglied.add', 'JTOOLBAR_NEW');
            }

            if ($canDo->get('core.edit') && isset($this->items[0])) {
                JToolBarHelper::editList('mitglied.edit', 'JTOOLBAR_EDIT');
            }
        }

        if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::custom('mitglieder.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
                JToolBarHelper::custom('mitglieder.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'mitglieder.delete', 'JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::archiveList('mitglieder.archive', 'JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
                JToolBarHelper::custom('mitglieder.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
        }

        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
            if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
                JToolBarHelper::deleteList('', 'mitglieder.delete', 'JTOOLBAR_EMPTY_TRASH');
                JToolBarHelper::divider();
            } else if ($canDo->get('core.edit.state')) {
                JToolBarHelper::trash('mitglieder.trash', 'JTOOLBAR_TRASH');
                JToolBarHelper::divider();
            }
        }

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_firefighters');
        }

        //Set sidebar action - New in 3.0
        JHtmlSidebar::setAction('index.php?option=com_firefighters&view=mitglieder');

        $this->extra_sidebar = '';
                                                        
        //Filter for the field dienstgrad;
        jimport('joomla.form.form');
        $options = array();
        JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
        $form = JForm::getInstance('com_firefighters.mitglied', 'mitglied');

        $field = $form->getField('dienstgrad');

        $query = $form->getFieldAttribute('filter_dienstgrad','query');
        $translate = $form->getFieldAttribute('filter_dienstgrad','translate');
        $key = $form->getFieldAttribute('filter_dienstgrad','key_field');
        $value = $form->getFieldAttribute('filter_dienstgrad','value_field');

        // Get the database object.
        $db = JFactory::getDBO();

        // Set the query and get the result list.
        $db->setQuery($query);
        $items = $db->loadObjectlist();

        // Build the field options.
        if (!empty($items))
        {
            foreach ($items as $item)
            {
                if ($translate == true)
                {
                    $options[] = JHtml::_('select.option', $item->$key, JText::_($item->$value));
                }
                else
                {
                    $options[] = JHtml::_('select.option', $item->$key, $item->$value);
                }
            }
        }

        JHtmlSidebar::addFilter(
            '$Dienstgrad',
            'filter_dienstgrad',
            JHtml::_('select.options', $options, "value", "text", $this->state->get('filter.dienstgrad')),
            true
        );                                                
        //Filter for the field abteilungen;
        jimport('joomla.form.form');
        $options = array();
        JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
        $form = JForm::getInstance('com_firefighters.mitglied', 'mitglied');

        $field = $form->getField('abteilungen');

        $query = $form->getFieldAttribute('filter_abteilungen','query');
        $translate = $form->getFieldAttribute('filter_abteilungen','translate');
        $key = $form->getFieldAttribute('filter_abteilungen','key_field');
        $value = $form->getFieldAttribute('filter_abteilungen','value_field');

        // Get the database object.
        $db = JFactory::getDBO();

        // Set the query and get the result list.
        $db->setQuery($query);
        $items = $db->loadObjectlist();

        // Build the field options.
        if (!empty($items))
        {
            foreach ($items as $item)
            {
                if ($translate == true)
                {
                    $options[] = JHtml::_('select.option', $item->$key, JText::_($item->$value));
                }
                else
                {
                    $options[] = JHtml::_('select.option', $item->$key, $item->$value);
                }
            }
        }

        JHtmlSidebar::addFilter(
            '$Abteilung(-en)',
            'filter_abteilungen',
            JHtml::_('select.options', $options, "value", "text", $this->state->get('filter.abteilungen')),
            true
        );                                                
        //Filter for the field ausbildungen;
        jimport('joomla.form.form');
        $options = array();
        JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
        $form = JForm::getInstance('com_firefighters.mitglied', 'mitglied');

        $field = $form->getField('ausbildungen');

        $query = $form->getFieldAttribute('filter_ausbildungen','query');
        $translate = $form->getFieldAttribute('filter_ausbildungen','translate');
        $key = $form->getFieldAttribute('filter_ausbildungen','key_field');
        $value = $form->getFieldAttribute('filter_ausbildungen','value_field');

        // Get the database object.
        $db = JFactory::getDBO();

        // Set the query and get the result list.
        $db->setQuery($query);
        $items = $db->loadObjectlist();

        // Build the field options.
        if (!empty($items))
        {
            foreach ($items as $item)
            {
                if ($translate == true)
                {
                    $options[] = JHtml::_('select.option', $item->$key, JText::_($item->$value));
                }
                else
                {
                    $options[] = JHtml::_('select.option', $item->$key, $item->$value);
                }
            }
        }

        JHtmlSidebar::addFilter(
            '$Ausbidung(-en)',
            'filter_ausbildungen',
            JHtml::_('select.options', $options, "value", "text", $this->state->get('filter.ausbildungen')),
            true
        );                                                
        //Filter for the field missions_eiko;
        jimport('joomla.form.form');
        $options = array();
        JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
        $form = JForm::getInstance('com_firefighters.mitglied', 'mitglied');

        $field = $form->getField('missions_eiko');

        $query = $form->getFieldAttribute('filter_missions_eiko','query');
        $translate = $form->getFieldAttribute('filter_missions_eiko','translate');
        $key = $form->getFieldAttribute('filter_missions_eiko','key_field');
        $value = $form->getFieldAttribute('filter_missions_eiko','value_field');

        // Get the database object.
        $db = JFactory::getDBO();

        // Set the query and get the result list.
        $db->setQuery($query);
        $items = $db->loadObjectlist();

        // Build the field options.
        if (!empty($items))
        {
            foreach ($items as $item)
            {
                if ($translate == true)
                {
                    $options[] = JHtml::_('select.option', $item->$key, JText::_($item->$value));
                }
                else
                {
                    $options[] = JHtml::_('select.option', $item->$key, $item->$value);
                }
            }
        }

        JHtmlSidebar::addFilter(
            '$Einsätze',
            'filter_missions_eiko',
            JHtml::_('select.options', $options, "value", "text", $this->state->get('filter.missions_eiko')),
            true
        );
		JHtmlSidebar::addFilter(

			JText::_('JOPTION_SELECT_PUBLISHED'),

			'filter_published',

			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), "value", "text", $this->state->get('filter.state'), true)

		);

    }

	protected function getSortFields()
	{
		return array(
		'a.id' => JText::_('JGRID_HEADING_ID'),
		'a.name' => JText::_('COM_FIREFIGHTERS_MITGLIEDER_NAME'),
		'a.vorname' => JText::_('COM_FIREFIGHTERS_MITGLIEDER_VORNAME'),
		'a.name_eiko' => JText::_('COM_FIREFIGHTERS_MITGLIEDER_NAME_EIKO'),
		'a.bild' => JText::_('COM_FIREFIGHTERS_MITGLIEDER_BILD'),
		'a.dienstgrad' => JText::_('COM_FIREFIGHTERS_MITGLIEDER_DIENSTGRAD'),
		'a.abteilungen' => JText::_('COM_FIREFIGHTERS_MITGLIEDER_ABTEILUNGEN'),
		'a.kommando' => JText::_('COM_FIREFIGHTERS_MITGLIEDER_KOMMANDO'),
		'a.funktion' => JText::_('COM_FIREFIGHTERS_MITGLIEDER_FUNKTION'),
		'a.ausbildungen' => JText::_('COM_FIREFIGHTERS_MITGLIEDER_AUSBILDUNGEN'),
		'a.eintrittsdatum' => JText::_('COM_FIREFIGHTERS_MITGLIEDER_EINTRITTSDATUM'),
		'a.austrittsdatum' => JText::_('COM_FIREFIGHTERS_MITGLIEDER_AUSTRITTSDATUM'),
		'a.missions_eiko' => JText::_('COM_FIREFIGHTERS_MITGLIEDER_MISSIONS_EIKO'),
		'a.state' => JText::_('JSTATUS'),
		'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
		'a.created_by' => JText::_('COM_FIREFIGHTERS_MITGLIEDER_CREATED_BY'),
		);
	}

}
