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

class FirefightersController extends JControllerLegacy {

    /**
     * Method to display a view.
     *
     * @param	boolean			$cachable	If true, the view output will be cached
     * @param	array			$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
     *
     * @return	JController		This object to support chaining.
     * @since	1.5
     */
    public function display($cachable = false, $urlparams = false) {
		require_once JPATH_SITE.'/administrator/components/com_firefighters/helpers/firefighters.php'; // Helper-class laden
		
		$params = JComponentHelper::getParams('com_firefighters');
		
		$db = JFactory::getDbo();
		$db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "com_firefighters"');
		$parameter = json_decode( $db->loadResult(), true );
        $version = $parameter['version'];

		// Version auf BETA überprüfen, und gegebenenfalls eine Warnung ausgeben
        if($version!=str_replace("beta","",$version)):
		?>
		<table>
		<tr>
		<div class="alert alert-info j-toggle-main " style="">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Hinweis :</h4>Achtung Beta-Version <?php echo $parameter['version'];?> !!! Es wird nicht empfohlen, diese Version der Einsatzkomponente auf einer öffentlichen Live-Webseite zu betreiben. 
		</div>        
		</tr>
		</table>
		<?php endif; ?>
		

<?php
		//------------------------------------------------------------------------
        if($version!=str_replace("Premium","",$version)):
		$params->set('ftm', '1');
		endif;  ?>
		
<?php if (!$params['ftm']) : ?>	 	
		<table>
		<tr>
		<div class="alert alert-danger j-toggle-main " style="">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9HDFKVJSKSEFY"><span style="float:left;"><img border=0  width="100px" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donateCC_LG.gif" /></span></a>
		Unterstützen Sie bitte die Weiterentwicklung unseres Projekts FIREFIGHTERS TEAM MANAGER mit einer Spende, damit wir unsere Software auch weiterhin kostenlos und werbefrei zur Verfügung stellen können.<br/><small>Dieses Fenster wird nach der Eingabe des Validationsschlüssel automatisch ausgeblendet</small>.  
		</div>        
		</tr>
		</table>
<?php endif; ?>

<?php	// Catch Sites 

		$j_version = new JVersion;
		$response = @file("http://einsatzkomponente.de/gateway/ftm_validation.php?validation=".$params->get('validation_key','0')."&domain=".$_SERVER['SERVER_NAME']."&version=".$j_version->getShortVersion()."&version=".$version); // Request absetzen

		
        $view = JFactory::getApplication()->input->getCmd('view', 'kontrollcenter');
        JFactory::getApplication()->input->set('view', $view);

        parent::display($cachable, $urlparams);

        return $this;
    }

}
