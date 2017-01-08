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
/**
 * Firefighters helper.
 */
class FirefightersHelper {

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($vName = '') {
		
		JHtmlSidebar::addEntry(
			JText::_('COM_FIREFIGHTERS_TITLE_KONTROLLCENTERS'),
			'index.php?option=com_firefighters&view=kontrollcenter',
			$vName == 'kontrollcenter'
		);
        		JHtmlSidebar::addEntry(
			JText::_('COM_FIREFIGHTERS_TITLE_ABTEILUNGEN'),
			'index.php?option=com_firefighters&view=abteilungen',
			$vName == 'abteilungen'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_FIREFIGHTERS_TITLE_DIENSTGRADE'),
			'index.php?option=com_firefighters&view=dienstgrade',
			$vName == 'dienstgrade'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_FIREFIGHTERS_TITLE_AUSBILDUNGEN'),
			'index.php?option=com_firefighters&view=ausbildungen',
			$vName == 'ausbildungen'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_FIREFIGHTERS_TITLE_MITGLIEDER'),
			'index.php?option=com_firefighters&view=mitglieder',
			$vName == 'mitglieder'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_FIREFIGHTERS_TITLE_TERMINE'),
			'index.php?option=com_firefighters&view=termine',
			$vName == 'termine'
		);

    }

    /**
     * Gets a list of the actions that can be performed.
     *
     * @return	JObject
     * @since	1.6
     */
    public static function getActions() {
        $user = JFactory::getUser();
        $result = new JObject;

        $assetName = 'com_firefighters';

        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
        );

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }
	
	
	
	public static function getVersion()
	{
		// Funktion : Installierte Version ermitteln
		$db = JFactory::getDbo();
		$db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "com_firefighters"');
		$params = json_decode( $db->loadResult(), true );
        $version = $params['version'];
        return $version;
	}
	
	    public static function getValidation() { 
		
		$db = JFactory::getDbo();
		$db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "com_firefighters"');
		$params = json_decode( $db->loadResult(), true );
        $eikoversion = $params['version'];

		$version = new JVersion;
		$params = JComponentHelper::getParams('com_firefighters');
		$response = @file("https://einsatzkomponente.de/gateway/ftm_validation.php?validation=".$params->get('validation_key','0')."&domain=".$_SERVER['SERVER_NAME']."&version=".$version->getShortVersion()."&ftmversion=".$eikoversion); // Request absetzen
		@$response_code = intval($response[1]); // Rückgabewert auslesen
if ($response_code=='12') :	
$params->set('ftm', '1');
$db = JFactory::getDBO();
$query = $db->getQuery(true);
$query->update('#__extensions AS a');
$query->set('a.params = ' . $db->quote((string)$params));
$query->where('a.element = "com_firefighters"');
$db->setQuery($query);
		try
		{
			$db->execute();
		}
		catch (RuntimeException $e)
		{
			JError::raiseError(500, $e->getMessage());
		}
else:
$params->set('ftm', '0');

		$db = JFactory::getDbo();
		$db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "com_firefighters"');
		$paramms = json_decode( $db->loadResult(), true );
        $version = $paramms['version'];
        if($version!=str_replace("Premium","",$version)):
		$params = JComponentHelper::getParams('com_firefighters');
		$params->set('ftm', '1');
		$response_code='12';
		endif;  

$db = JFactory::getDBO();
$query = $db->getQuery(true);
$query->update('#__extensions AS a');
$query->set('a.params = ' . $db->quote((string)$params));
$query->where('a.element = "com_firefighters"');
$db->setQuery($query);
//$db->query();
		try
		{
			$db->execute();
		}
		catch (RuntimeException $e)
		{
			JError::raiseError(500, $e->getMessage());
		}
endif;		
		return $response_code;
		}


		
		
}
