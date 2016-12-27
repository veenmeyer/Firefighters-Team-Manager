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

function save($key = NULL, $urlVar = NULL) {
 			
 		require_once JPATH_SITE.'/administrator/components/com_firefighters/helpers/firefighters.php'; 
 		$val= FirefightersHelper::getValidation();
 		
 		if (!$val) :  
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