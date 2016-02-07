<?php
/**
 * @version     3.0.0
 * @package     com_firefighters
 * @copyright   Copyright (C) 2013 by Ralf Meyer. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ralf Meyer <webmaster@feuerwehr-veenhusen.de> - http://einsatzkomponente.de
 */
// No direct access
defined('_JEXEC') or die;
jimport( 'joomla.filesystem.file' );
jimport( 'joomla.filesystem.folder' );
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_firefighters/assets/css/firefighters.css');
// try to set time limit
@set_time_limit(0);
// try to increase memory limit
if ((int) ini_get('memory_limit') < 32) {
          @ini_set('memory_limit', '64M');
		}
// Versions-Nummer 
$db = JFactory::getDbo();
$db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "com_firefighters"');
$params = json_decode( $db->loadResult(), true );
	

$bug='0';	
		
?>
<div align="left">
<?php
		echo '<h2>'.JTEXT::_('Installationsmanager für Firefighters Team Manager Version ').$params['version'].'</h2>'; 
		
		?>
		<a target="_blank" href="http://www.einsatzkomponente.de/index.php"><img border=0  src="<?php echo JURI::base(); ?>components/com_firefighters/assets/images/komponentenbanner.jpg"/></a><br/><br/>
        <?php

		
		
?>
<?php echo '<br/><br/>';?>

<?php if ($bug == '0') : ?>
<?php echo '<span class="label label-success">Installation erfolgreich ...</span><br/><br/>';?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div align="center">
<input
   type="button"
   class="btn btn-primary"
   value=" weiter zum Kontrollzentrum "
   title=""
   onclick="window.location='index.php?option=com_firefighters&view=kontrollcenter'"
   /></div>
</form>
<?php endif; ?>

<?php if ($bug == '1') : ?>
<?php echo '<span class="label label-important">Installation nicht erfolgreich ...</span><br/><br/>Versuchen Sie es nochmal, oder wenden Sie sich an das Supportforum : <a href="http://www.einsatzkomponente.de" target="_blank">http://www.einsatzkomponente.de</a>';?>
<?php endif; ?>

<?php if ($bug == '2') : ?>
<?php echo '<span class="label label-success">Installation erfolgreich ...</span><br/><br/>';?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div align="center">
<input
   type="button"
   class="btn btn-primary"
   value=" weiter zum Kontrollzentrum "
   title=""
   onclick="window.location='index.php?option=com_firefighters&view=kontrollcenter'"
   />
<input
   type="button"
   class="btn btn-danger"
   value=" alte Datenbanktabellen importieren ? "
   title=""
   onclick="window.location='index.php?option=com_firefighters&view=datenimport'"
   />   </div>
</form>
<?php endif; ?>

</div>
<?php
?>
