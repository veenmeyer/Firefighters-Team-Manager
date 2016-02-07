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




