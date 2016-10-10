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

jimport('joomla.application.component.controllerform');

/**
 * Termin controller class.
 */
class FirefightersControllerTermin extends JControllerForm
{

    function __construct() {
        $this->view_list = 'termine';
        parent::__construct();
    }

		function save() {
		$db = JFactory::getDbo();
		$db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "com_firefighters"');
		$parameter = json_decode( $db->loadResult(), true );
        $version = $parameter['version'];

		$params = JComponentHelper::getParams('com_firefighters');
        if($version!=str_replace("Premium","",$version)):
		$params->set('ftm', '1');
		else:
		$params->set('ftm', '0');
		endif; 
		
		if (!$params['ftm']) :  
					$db = JFactory::getDbo();
					$query_2 = $db->getQuery(true);
					$query_2
							->select('COUNT(id)') 
							->from('`#__firefighters_termine`');
							//->where('id = ' . $db->quote($db->escape($value)));
					$db->setQuery($query_2);
					$result = $db->loadResult();
					if ($result > 4) : 
					JLog::add(JText::_('Terminanzahl beschränkt auf 5 !'), JLog::WARNING, 'jerror');
					$this->setRedirect('index.php?option=com_firefighters&view=termine', $msg); 
					else:
					return parent::save();
					endif;
		else:
		return parent::save();
		endif;
		return;
		
	}

}