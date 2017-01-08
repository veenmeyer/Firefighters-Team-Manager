<?php

/**
 * @version     1.0.0
 * @package     com_firefighters
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Ralf Meyer <ralf.meyer@mail.de> - https://einsatzkomponente.de
 */
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of Firefighters.
 */
class FirefightersViewTermine extends JViewLegacy {

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

        FirefightersHelper::addSubmenu('termine');

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

        JToolBarHelper::title(JText::_('COM_FIREFIGHTERS_TITLE_TERMINE'), 'termine.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/termin';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
                JToolBarHelper::addNew('termin.add', 'JTOOLBAR_NEW');
            }

            if ($canDo->get('core.edit') && isset($this->items[0])) {
                JToolBarHelper::editList('termin.edit', 'JTOOLBAR_EDIT');
            }
        }

        if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::custom('termine.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
                JToolBarHelper::custom('termine.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'termine.delete', 'JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::archiveList('termine.archive', 'JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
                JToolBarHelper::custom('termine.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
        }

        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
            if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
                JToolBarHelper::deleteList('', 'termine.delete', 'JTOOLBAR_EMPTY_TRASH');
                JToolBarHelper::divider();
            } else if ($canDo->get('core.edit.state')) {
                JToolBarHelper::trash('termine.trash', 'JTOOLBAR_TRASH');
                JToolBarHelper::divider();
            }
        }

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_firefighters');
        }

        //Set sidebar action - New in 3.0
        JHtmlSidebar::setAction('index.php?option=com_firefighters&view=termine');

        $this->extra_sidebar = '';
                                                        
        //Filter for the field abteilungen;
        jimport('joomla.form.form');
        $options = array();
        JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
        $form = JForm::getInstance('com_firefighters.termin', 'termin');

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
            '$Abteilungen',
            'filter_abteilungen',
            JHtml::_('select.options', $options, "value", "text", $this->state->get('filter.abteilungen')),
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
		'a.name' => JText::_('COM_FIREFIGHTERS_TERMINE_NAME'),
		'a.bild' => JText::_('COM_FIREFIGHTERS_TERMINE_BILD'),
		'a.email' => JText::_('COM_FIREFIGHTERS_TERMINE_EMAIL'),
		'a.abteilungen' => JText::_('COM_FIREFIGHTERS_TERMINE_ABTEILUNGEN'),
		'a.datum_start' => JText::_('COM_FIREFIGHTERS_TERMINE_DATUM_START'),
		'a.datum_ende' => JText::_('COM_FIREFIGHTERS_TERMINE_DATUM_ENDE'),
		'a.email_gesendet' => JText::_('COM_FIREFIGHTERS_TERMINE_EMAIL_GESENDET'),
		'a.state' => JText::_('JSTATUS'),
		'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
		'a.created_by' => JText::_('COM_FIREFIGHTERS_TERMINE_CREATED_BY'),
		);
	}

}
