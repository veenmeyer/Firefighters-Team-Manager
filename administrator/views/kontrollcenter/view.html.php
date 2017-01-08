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
class FirefightersViewKontrollcenter extends JViewLegacy {

    protected $items;
    protected $pagination;
    protected $state;
	protected $params;

    /**
     * Display the view
     */
    public function display($tpl = null) {
		
        $this->state = $this->get('State');
		$this->params = JComponentHelper::getParams('com_firefighters');
        

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }

        FirefightersHelper::addSubmenu('kontrollcenter');

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

        JToolBarHelper::title(JText::_('COM_FIREFIGHTERS_TITLE_KONTROLLCENTERS'), 'kontrollcenters.png');



        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_firefighters');
        }

        //Set sidebar action - New in 3.0
        JHtmlSidebar::setAction('index.php?option=com_firefighters&view=kontrollcenter');

        $this->extra_sidebar = '';
        //
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
