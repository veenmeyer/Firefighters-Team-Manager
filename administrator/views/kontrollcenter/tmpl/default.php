<?php
/**
 * @version     3.0.0
 * @package     com_firefighters
 * @copyright   Copyright (C) 2013 by Ralf Meyer. All rights reserved.
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
						
	    					<a class="btn" href="index.php?option=com_firefighters&view=einsatzberichte">
		    				<img style="width:32px;height:32px;" alt="<?php echo JText::_('COM_FIREFIGHTERS_TITLE'); ?>" src="components/com_firefighters/assets/images/liste.png" /><br/>
		    				<span style="font-size:11px;"><?php echo JText::_('COM_FIREFIGHTERS_TITLE'); ?></span>
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


<p><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9HDFKVJSKSEFY"><span style="float:right;">Spenden über PAYPAL : <img border=0  src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donateCC_LG.gif" /></span></a>
<p><small><span style="float:right;"></br>Alternativ können Sie die Kontodaten per <a href="mailto:validate@einsatzkomponente.de?Subject=Spende%20Einsatzkomponente%20J3.x" target="_top">Email </a>anfordern.</span></small></p></p>


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
							<?php if ($this->params->get('ftm')) : ?>
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
							<?php if ($this->params->get('ftm')) : ?>
							<?php echo '<span style="margin-bottom:5px;" class="label label-success">unlimitierte Anzahl von Mitglieder</span></br>';?>
							<?php else:?>
							<?php echo '<span style="margin-bottom:5px;text-decoration: line-through;" class="label label-important">unlimitierte Anzahl von Mitglieder</span></br>';?>
							<?php endif;?>
							<hr>
						<b>Informationen:</b></br>
						<a target="_blank" style="margin-bottom:5px;" style="margin-bottom:5px;" class="label label-info" href="http://www.einsatzkomponente.de">Download-Link Webseite</a> 
						<br/>
						<!--<a target="_blank" style="margin-bottom:5px;" class="label label-info" href="https://github.com/veenmeyer/Einsatzkomponente">Link zu GitHub</a> -->			
					</br>
						<!-- Button to trigger modal -->
						<a href="#myModal" role="button" style="margin-bottom:5px;" class="label label-info" data-toggle="modal">Verfügbare Module ...</a>
     
						<!-- Modal -->
						<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">Verfügbare Module</h3>
						</div>
						<div class="modal-body">
						<ul>
						<li><a href="http://www.einsatzkomponente.de/wsif/index.php/Category/6-Module-f%C3%BCr-die-Einsatzkomponente-V3/" target="_blank" class="">mod_ftm_kalender</a> (Modul zur Anzeige der nächsten Termine auf einer Modulposition)</li>
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
								echo '<span class="label label-success">allow_url_fopen aktiv</span>';
								} else {
								echo '<span class="label label-important">allow_url_fopen deaktiviert</span>';
								}
						?>
					<hr>
						Aktuellste Version: <iframe  frameborder="0" height="30px" width="250px" src="http://www.feuerwehr-veenhusen.de/images/firefightersJ30/index.html" scrolling="no"></iframe>
						
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
						<a target="_blank" href="http://einsatzkomponente.de" style="text-decoration:underline">Supportforum für die Einsatzkomponente</a>
						</li>
						<li>
						<a target="_blank" href="http://www.leitstelle-joomla.de" style="text-decoration:underline">Testseite für die Einsatzkomponente V3.x für J3</a>
						</li>
						<li>
						<a target="_blank" href="http://www.feuerwehr-veenhusen.de" style="text-decoration:underline">Freiwillige Feuerwehr Veenhusen </a><font-size:small>(über ein paar nette im Gästebuch würde ich mich sehr freuen  lg Ralf Meyer )</font-size>
						</li>
						</ul>
						</div>
                  </td>
             </tr>
                
            </tbody>
			<tfoot>
				<tr>
					<td colspan="10">
						<?php echo 'Copyright (C) 2013 by Ralf Meyer. All rights reserved.
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
					$ret .= ''.$line.'</br>';
					break;
				case '+':
					$ret .= '<span style="font-size:8pt;color:#ff0000;">Added:</span> '.$line."</br>";
					break;
				case '#':
					$ret .= '<span style="font-size:8pt;color:#00e600;">Bugfix:</span> '.$line."</br>";
					break;

				default:



					$ret .= $line;
					break;
			}
		}

		return $ret;
	}
	
?>