<?php

/**
 * @package     com_einsatzkomponente
 *
 * @author      Ralf Meyer <ralf.meyer@einsatzkomponente.de>
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 */

define('MODIFIED', 1);
define('NOT_MODIFIED', 2);

class com_firefightersInstallerScript
{
	public function preflight($type, $parent)
	{
		
		    if ( $type == 'update' ) 
    {
        $this->oldRelease = $this->getParam('version');
        if (version_compare($this->oldRelease, $this->release, 'lt'))
        {
            //Repair table #__schema which was not used before
            //Just create a dataset with extension id and old version (before update).
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select($db->quoteName('extension_id'))
                ->from('#__extensions')
                ->where($db->quoteName('type') . ' = ' . $db->quote('component') . ' AND ' . $db->quoteName('element') . ' = ' . $db->quote('com_firefighters') . ' AND ' . $db->quoteName('name') . ' = ' . $db->quote('com_firefighters'));
            $db->setQuery($query);
            if ($eid = $db->loadResult())
            {
                $query->clear();
                $query->insert($db->quoteName('#__schemas'));
                $query->columns(array($db->quoteName('extension_id'), $db->quoteName('version_id')));
                $query->values($eid . ', ' . $db->quote($this->oldRelease));
                $db->setQuery($query);
                $db->execute();
            }
        }
    }
	
		$jversion = new JVersion();
 
		// Installing component manifest file version
		$this->release = $parent->get( "manifest" )->version;
 
		// Manifest file minimum Joomla version
		$this->minimum_joomla_release = $parent->get( "manifest" )->attributes()->version;  
		
		// Installing component manifest file version
		$manifest = $parent->get("manifest");
		$release  = (string) $manifest['version'];
 
 
		// Show the essential information at the install/update back-end
		echo '<div class="alert alert-block alert-info">';
		echo 'Installiere jetzt die Komponente Firefighters Version = ' . $this->release;
		echo '<br />Mindestens erforderliche Joomla-Version = ' . $this->minimum_joomla_release;
		echo '<br />Aktuelle Joomla-Version = ' . $jversion->getShortVersion();
		echo '</div>';
		

		if (!$jversion->isCompatible($release))
		{
			JFactory::getApplication()->enqueueMessage(
				JText::_('Diese Komponente ist nicht mit der installierten Joomla-Version kompatibel'),
				'error'
			);

			return false;
		}

		return true;
	}

	public function install($parent)
	{
		//$this->db_update($parent);
		$parent->getParent()->setRedirectURL('index.php?option=com_firefighters&view=installation');
	}

	public function update($parent) 
	{
		//$this->db_update($parent);
		$parent->getParent()->setRedirectURL('index.php?option=com_firefighters&view=kontrollcenter');
	}

	public function uninstall($parent)
	{}
	private function db_update($parent)
	{}


	
}




