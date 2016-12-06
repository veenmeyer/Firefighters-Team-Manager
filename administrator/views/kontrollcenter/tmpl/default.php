<?php
/**
 * @version     3.0.0
 * @package     com_firefighters
 * @copyright   Copyright (C) 2016 by Ralf Meyer. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Ralf Meyer <webmaster@feuerwehr-veenhusen.de> - http://einsatzkomponente.de
 */
// no direct access
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

JHtml::_('behavior.multiselect');

	JHtml::_('bootstrap.tooltip');
	JHtml::_('formbehavior.chosen', 'select'); 

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_firefighters/assets/css/firefighters.css');
// Versions-Nummer 
$db = JFactory::getDbo();
$db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "com_firefighters"');
$params = json_decode( $db->loadResult(), true );

$user	= JFactory::getUser();
$userId	= $user->get('id');

require_once JPATH_SITE.'/administrator/components/com_firefighters/helpers/firefighters.php'; 
$val= FirefightersHelper::getValidation();

?>

<?php
if (!empty($this->extra_sidebar)) {
    $this->sidebar .= $this->extra_sidebar;
}

?>
<form action="<?php echo JRoute::_('index.php?option=com_firefighters&view=kontrollcenters'); ?>" method="post" name="adminForm" id="adminForm">
<?php if(!empty($this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>

							
		<div id="filter-bar" class="btn-toolbar"></div> 
               
        
			  <div class="btn-group btn-group-justified">
						
	    					<a class="btn" href="index.php?option=com_firefighters&view=termine">
		    				<img style="width:32px;height:32px;" alt="<?php echo JText::_('Termine'); ?>" src="components/com_firefighters/assets/images/l_termine.png" /><br/>
		    				<span style="font-size:11px;"><?php echo JText::_('Termine'); ?></span>
	    					</a>
							
	    					<a class="btn" href="index.php?option=com_firefighters&view=mitglieder">
		    				<img style="width:32px;height:32px;" alt="<?php echo JText::_('Termine'); ?>" src="components/com_firefighters/assets/images/l_mitglieder.png" /><br/>
		    				<span style="font-size:11px;"><?php echo JText::_('Mitglieder'); ?></span>
	    					</a>

	    					<a class="btn" href="index.php?option=com_firefighters&view=abteilungen">
		    				<img style="width:32px;height:32px;" alt="<?php echo JText::_('Abteilungen'); ?>" src="components/com_firefighters/assets/images/l_abteilungen.png" /><br/>
		    				<span style="font-size:11px;"><?php echo JText::_('Abteilungen'); ?></span>
	    					</a>
							
	    					<a class="btn" href="index.php?option=com_firefighters&view=dienstgrade">
		    				<img style="width:32px;height:32px;" alt="<?php echo JText::_('Dienstgrade'); ?>" src="components/com_firefighters/assets/images/l_dienstgrade.png" /><br/>
		    				<span style="font-size:11px;"><?php echo JText::_('Dienstgrade'); ?></span>
	    					</a>
							
	    					<a class="btn" href="index.php?option=com_firefighters&view=ausbildungen">
		    				<img style="width:32px;height:32px;" alt="<?php echo JText::_('Ausbildungen'); ?>" src="components/com_firefighters/assets/images/l_ausbildungen.png" /><br/>
		    				<span style="font-size:11px;"><?php echo JText::_('Ausbildungen'); ?></span>
	    					</a>
							
							</div>
					
					
			<table class="table"> 
			<thead>
				<tr>
					<th>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>

<div class="span4">
<div class="alert alert-info" style=" float:left;">
<a target="_blank" href="http://www.einsatzkomponente.de/index.php"><img src="<?php echo JURI::base(); ?>components/com_firefighters/assets/images/komponentenbanner.jpg" style="float:left; margin-right:20px; padding-right:20px;"/></a>
<span class="label label-important">Was könnt Ihr zur Entwicklung beitragen ?</span><br/><br/>
Neben sehr viel Freizeit kostet die Entwicklung unserer Software und der Unterhalt dieser Supportseite natürlich auch Geld.
Unterstützen Sie die Weiterentwicklung unseres Projekts FIREFIGHTERS TEAM MANAGER mit einer Spende, damit wir unsere Software auch weiterhin kostenlos und werbefrei zur Verfügung stellen können.
<br/>Vielen Dank ! <br />
<small>Kontakt: <?php echo $params['authorEmail'];?></small><br />


<p><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=XPQALX4UFFGM4"><span style="float:right;">Spenden über PAYPAL : <img border=0  src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donateCC_LG.gif" /></span></a>
<p><small><span style="float:right;"></br>Alternativ können Sie die Kontodaten per <a href="mailto:validate@einsatzkomponente.de?Subject=Spende%20Firefighters%20Team%20Manager%20J3.x" target="_top">Email </a>anfordern.</span></small></p></p>



</div>
</div>
<div class="span5">
					<div class="well well-small" style=" float:left;">
						<div class="center">
							<?php echo '<h4>'.JTEXT::_('FIREFIGHTERS TEAM MANAGER für das Joomla-CMS ');?><?php echo '</h4>';?>
						</div>
						<hr class="hr-condensed">
						<dl class="dl-horizontal">
							<dt>Version:</dt>
							<dd><?php echo $params['version'];?>
							<?php if ($val) : ?>
							<?php echo '<span class="label label-success"> ( validiert ) </span>';?>
                            <?php else:?>
							<?php echo '<span class="label label-important"> ( nicht validiert ) </span><br/>siehe Optionen / Info';?>
                            <?php endif;?>
							
								<?php JHtml::_('behavior.modal'); ?>
								</br>
								<div style="display:none;">
								<div id="eiko-changelog">
									<?php
										echo changelog (JPATH_COMPONENT_ADMINISTRATOR.'/CHANGELOG.php');
									?>
								</div>
								</div>
						<a href="#eiko-changelog" class="modal"><?php echo 'Changelog'; ?></a>

                            </dd>
							<hr>
							<dt>Release-Datum:</dt>
							<dd><?php echo $params['creationDate'];?></dd>
							<dt>Autor:</dt>
							<dd><?php echo $params['author'];?></dd>
							<dt>Autor-Email:</dt>
							<dd><?php echo $params['authorEmail'];?></dd>
							<dt>Copyright:</dt>
							<dd><?php echo $params['copyright'];?></dd>
							<dt>Lizenz:</dt>
							<dd>GNU General Public License version 2 or later </dd>
						</dl>
						<hr>
							<b>Premiumfunktionen:</b></br>
							<?php if ($val) : ?>
							<?php echo '<span style="margin-bottom:5px;" class="label label-success">unlimitierte Anzahl von Mitglieder</span></br>';?>
							<?php echo '<span style="margin-bottom:5px;" class="label label-success">unlimitierte Anzahl von Terminen</span></br>';?>
							<?php else:?>
							<?php echo '<span style="margin-bottom:5px;text-decoration: line-through;" class="label label-important">unlimitierte Anzahl von Mitglieder</span></br>';?>
							<?php echo '<span style="margin-bottom:5px;text-decoration: line-through;" class="label label-important">unlimitierte Anzahl von Terminen</span></br>';?>
							<?php endif;?>
							
							<?php $plugin = JPluginHelper::getPlugin('system', 'ftm_event_mail') ;
							if ($plugin) : 
							?>
												<span class="label label-success">Das Plugin ftm_event_mail ist aktivert</span>
							<?php else : ?>
												<span class="label label-important">Das Plugin <b>ftm_event_mail</b> ist nicht aktivert</span><span class="icon-info-2 large-icon" style="font-size:18px;" title="Diese Plugin wird benötigt, wenn Errinnerungsmails zu den Terminen versandt werden sollen. Du findest das Plugin im Downloadcenter bei einsatzkomponente.de"> </span>
							<?php endif;?>
							
							<hr>
						<b>Informationen:</b></br>
						<a target="_blank" style="margin-bottom:5px;" style="margin-bottom:5px;" class="label label-info" href="http://www.einsatzkomponente.de">Download-Link Webseite</a> 
						<br/>
						<!-- Button to trigger modal -->
						<a href="#myModal" role="button" style="margin-bottom:5px;" class="label label-info" data-toggle="modal">Verfügbare Module und Plugins ...</a>
     
						<!-- Modal -->
						<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">Verfügbare Module und Plugins</h3>
						</div>
						<div class="modal-body">
						<ul>
						<li><a href="http://einsatzkomponente.de/wsif/index.php/Category/12-Module-f%C3%BCr-Firefighters-Team-Manager/" target="_blank" class="">mod_ftm_kalender</a> (Modul zur Anzeige der nächsten Termine auf einer Modulposition)</li>
						<li><a href="http://einsatzkomponente.de/wsif/index.php/Category/13-Premiumbereich-FTM-nur-f%C3%BCr-Premium-FTM-Benutzer-zug%C3%A4nglich/" target="_blank" class="">plg_system_ftm_event_email</a> (Plugin zum Verschicken von Erinnerungs-Emails für bevorstehende Termine. )</li>
						</ul>
						<h4>Mehr Infos dazu auf <a href="http://www.einsatzkomponente.de/" target="_blank" class="">www.einsatzkomponente.de</a></h4>
						</div>
						<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Schliessen</button>
						<!--<button class="btn btn-primary">Save changes</button> !-->
						</div>
						</div>	
						<hr>
						<b>Info PHP-Funktionen:</b></br>
						
						<?php 
							if( ini_get('allow_url_fopen') ) {
								echo '<span class="label label-success">allow_url_fopen aktiv</span> ';
								} else {
								echo '<span class="label label-important">allow_url_fopen deaktiviert</span> <span class="icon-info-2 large-icon" style="font-size:18px;" title="Diese PHP-Funktion ist leider auf Ihrem Server deaktiviert. Die Funktion wird zwingend für den Fall einer Online-Validation benötigt. Bei einigen Webhoster kann man die Funktion im Controlpanel des Webhostes selbst aktivieren. Ansonsten einfach mal beim Support des Webhosters anfragen, ob diese Funktion freigeschaltet werden kann."> </span>';
								}
						?>
					<hr>
						Aktuellste Version: <iframe  frameborder="0" height="30px" width="250px" src="https://www.feuerwehr-veenhusen.de/images/firefightersJ30/index.html" scrolling="no"></iframe>
						
</div> 
          

				
						
					</td>
                    
               </tr>
               
                
                <tr>
               		 <td>
						<div class="alert alert-block alert-info">
						<button class="close" data-dismiss="alert" type="button">×</button>
						<p> </p>
						<h4 style="margin-bottom:5px;">Weitere Links</h4>
						<ul>
						<li>
						<a target="_blank" href="https://einsatzkomponente.de" style="text-decoration:underline">Supportforum für die Einsatzkomponente</a>
						</li>
						<li>
						<a target="_blank" href="https://demo.einsatzkomponente.de/" style="text-decoration:underline">Testseite für die Einsatzkomponente V3.x für J3</a>
						</li>
						<li>
						<a target="_blank" href="https://www.feuerwehr-veenhusen.de" style="text-decoration:underline">Freiwillige Feuerwehr Veenhusen </a>
						</li>
						</ul>
						</div>
                  </td>
             </tr>
                
            </tbody>
			<tfoot>
				<tr>
					<td colspan="10">
						<?php echo 'Copyright (C) 2016 by Ralf Meyer. All rights reserved.
 *  GNU General Public License version 2 or later'; ?>
					</td>
				</tr>
			</tfoot>
            
		</table>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>     
	
<?php	
	function changelog($file, $onlyLast = false)
	{
		$ret = '';

		$lines = @file($file);

		if(empty($lines)) return $ret;

		array_shift($lines);

		foreach($lines as $line)
		{
			$line = trim($line);

			if(empty($line)) continue;

			$type = substr($line,0,1);

			switch($type)
			{
				case '=':
					continue;
					break;
				case '-':
					$ret .= '<li><span style="font-size:8pt;color:#ff0000;">Removed:</span> '.substr($line, 1).'</li>';
					break;
				case '+':
					$ret .= '<li><span style="font-size:8pt;color:#ff0000;">Added:</span> '.substr($line, 1)."</li>";
					break;
				case '#':
					$ret .= '<li><span style="font-size:8pt;color:#00e600;">Bugfix:</span> '.substr($line, 1)."</li>";
					break;

				default:



					$ret .= $line;
					break;
			}
		}

		return $ret;
	}
	
?>