<?php
/**
 * @version     1.0.0
 * @package     com_firefighters
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Ralf Meyer <ralf.meyer@mail.de> - https://einsatzkomponente.de
 */
// no direct access
defined('_JEXEC') or die;


$canEdit = JFactory::getUser()->authorise('core.edit', 'com_firefighters.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_firefighters' . $this->item->id)) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ($this->item) : ?>


<div class="container">
  <div class="row">
	
	
<!--Titelbild mit Highslide JS-->

				<?php if ($this->params->get('show_passbild','0') == '0'  OR $this->params->get('show_passbild','0') == '1') : ?>
				<?php if ($this->item->bild) : ?>
				<div class="span2">
<a href="<?php echo JURI::Root().$this->item->bild;?>" rel="highslide[<?php echo $this->item->id; ?>]" class="highslide" onClick="return hs.expand(this, { captionText: '<?php echo $this->item->vorname.' '.$this->item->name;?>' });" alt ="<?php echo $this->item->vorname.' '.$this->item->name;?>">
                  <img class="ftm_passbild" src="<?php echo JURI::Root().$this->item->bild;?>"  alt="<?php echo $this->item->vorname.' '.$this->item->name;?>" title="<?php echo $this->item->vorname.' '.$this->item->name;?>"/>
                  </a>
				</div>
				<?php endif;?>
				<?php endif;?>

<!--Titelbild mit Highslide JS  ENDE--> 



    <div class="span4">
        <p>
			<?php echo '<span class="ftm_detail_1_name">'.$this->item->vorname.' '.$this->item->name.'</span>'; ?>
			<br/>	
			<?php if ($this->params->get('show_dienstgrad','0') == '0'  OR $this->params->get('show_dienstgrad','0') == '1') : ?>
			<?php if ($this->item->dienstgrad) : ?>
			<?php echo '( '.$this->item->dienstgrad.' )'; ?>
			<?php endif;?>
			<?php endif;?>

			<?php if ($this->params->get('show_dienstgrad_image','0') == '0'  OR $this->params->get('show_dienstgrad_image','0') == '1') : ?>
				<?php if ($this->item->dienstgrad_image) : ?>
					<img class="ftm_detail_3_dienstgrad_image" src="<?php echo JURI::Root();?><?php echo $this->item->dienstgrad_image;?>" alt="<?php echo $this->item->dienstgrad;?>" title="<?php echo $this->item->dienstgrad;?>"/>
				<?php endif;?>
				<?php endif;?>
		</p>
		
		
		<?php if ($this->params->get('show_alter','0') == '0'  OR $this->params->get('show_alter','0') == '1') : ?>
					<?php if ($this->item->geburtsdatum != '0000-00-00 00:00:00') : ?>
					<?php echo 'Alter: '.floor((time() - strtotime($this->item->geburtsdatum)) / 31558149.540288); ?>
					<?php endif;?>
				<br/>
					<?php endif; ?>
					
		<?php if ($this->params->get('show_eintrittsdatum','0') == '0'  OR $this->params->get('show_eintrittsdatum','0') == '1') : ?>
					<?php if ($this->item->eintrittsdatum != '0000-00-00 00:00:00') : ?>
					<?php //echo 'Eintrittsjahr : '.date('Y', strtotime($item->eintrittsdatum)); ?>
					<?php echo 'Seit '.floor((time() - strtotime($this->item->eintrittsdatum)) / 31558149.540288).' Jahr(en) Mitglied in der Feuerwehr'; ?>
				<br/><br/>
					<?php endif; ?>
					<?php endif; ?>
					
		<p>
		
			<?php if ($this->params->get('show_email','0') == '0'  OR $this->params->get('show_email','0') == '1') : ?>
			<?php if ($this->item->emailadresse) : ?>
			
			<?php echo 'Kontakt: <i class="icon-envelope"></i> '.JHTML::_('email.cloak', $this->item->emailadresse); ?> <br>
			<?php endif;?>
			<br>
			<?php endif;?>

		
		<?php if ($this->params->get('show_funktionen','0') == '0'  OR $this->params->get('show_funktionen','0') == '1') : ?>
		<?php if ($this->item->funktion) : ?>
        <?php echo 'Funktion(-en): '.$this->item->funktion; ?> <br>
		<?php endif;?>
		<?php endif;?>
		
		
					<?php if ($this->params->get('show_abteilungen_list','1') == '1') : ?>
					<?php if ($this->params->get('show_abteilungen','0') == '0'  OR $this->params->get('show_abteilungen','0') == '1') : ?>
					<?php if ($this->item->abteilungen) : ?>
					<?php echo 'Abteilung(-en): '.$this->item->abteilungen; ?> <br>
					<?php endif;?>
					<?php endif; ?>
					<?php endif; ?>
	
					<?php if ($this->params->get('show_abteilungen_list','1') == '0') : ?>
					<?php if ($this->params->get('show_abteilungen','0') == '0'  OR $this->params->get('show_abteilungen','0') == '1') : ?>
					<?php if ($this->item->abteilungen) : ?>
					<?php $abteilungen = explode (',',$this->item->abteilungen);?>
					<?php echo '<table style="border:0px;margin-left:-2px;margin-top:5px;padding-top:5px;"><tr><td style="vertical-align:top">Abteilung(-en): </td><td>'; ?>
					<?php foreach ( $abteilungen as $abteilung) :  ?>
					<?php echo '<li>'.$abteilung.'</li>';?>
					<?php endforeach; ?>
					<?php echo '</td></tr></table>';?>
					<?php endif; ?>
					<?php endif; ?>
					<?php endif; ?>
		
					<?php if ($this->params->get('show_ausbildungen_list','1') == '1') : ?>
					<?php if ($this->params->get('show_ausbildungen','0') == '0'  OR $this->params->get('show_ausbildungen','0') == '1') : ?>
					<?php if ($this->item->ausbildungen) : ?>
					<?php echo 'Ausbildung(-en): '.$this->item->ausbildungen; ?><br/>
					<?php endif; ?>
					<?php endif; ?>
					<?php endif; ?>
					
					<?php if ($this->params->get('show_ausbildungen_list','1') == '0') : ?>
					<?php if ($this->params->get('show_ausbildungen','0') == '0'  OR $this->params->get('show_ausbildungen','0') == '1') : ?>
					<?php if ($this->item->ausbildungen) : ?>
					<?php $ausbildungen = explode (',',$this->item->ausbildungen);?>
					<?php echo '<table style="border:0px;margin-left:-2px;margin-top:5px;padding-top:5px;"><tr><td style="vertical-align:top">Ausbildung(-en): </td><td>'; ?>
					<?php foreach ( $ausbildungen as $ausbildung) :  ?>
					<?php echo '<li>'.$ausbildung.'</li>';?>
					<?php endforeach; ?>
					<?php echo '</td></tr></table>';?>
					<?php endif; ?>
					<?php endif; ?>
					<?php endif; ?>
					
		
		
			<?php $version = new JVersion;?>
			<?php if ($version->isCompatible('3.7')) :?>
			
					<?php if ($this->params->get('show_list_dienstgrad','0') != '4') : ?>
					
					<?php if ($this->params->get('show_dienstgrad_list','1') == '1') : ?>
					<?php if ($this->params->get('show_list_dienstgrad','0') == '0'  OR $this->params->get('show_list_dienstgrad','0') == '1') : ?>
					<?php if ($this->item->list_dienstgrad) : ?>
					<?php $laufbahn = array();?>
					<?php foreach ($this->item->list_dienstgrad as $itemz) : ?>
					<?php $laufbahn[] = $itemz['dienstgrad'].' ('.date('Y',strtotime($itemz['dienstgrad_datum'])).')'; ?>
					<?php endforeach; ?>
					<?php $laufbahn = implode (', ',$laufbahn);?>
					<?php echo '<b>Laufbahn: </b>'.$laufbahn;?> <br/>
					<?php endif;?>
					<?php endif;?>
					<?php endif;?>
		
					<?php if ($this->params->get('show_dienstgrad_list','1') == '0') : ?>
					<?php if ($this->params->get('show_list_dienstgrad','0') == '0'  OR $this->params->get('show_list_dienstgrad','0') == '1') : ?>
					<?php if ($this->item->list_dienstgrad) : ?>
					<?php echo '<table style="border:0px;margin-left:-2px;margin-top:5px;padding-top:5px;"><tr><td style="vertical-align:top">Laufbahn: </td><td>'; ?>
					<?php foreach ($this->item->list_dienstgrad as $itemz) : ?>
					<?php echo '<li>'.$itemz['dienstgrad'].' ('.date('Y',strtotime($itemz['dienstgrad_datum'])).')</li>'; ?>
					<?php endforeach; ?>
					<?php echo '</td></tr></table><br/>';?>
					<?php endif;?>
					<?php endif;?>
					<?php endif;?>
					
					<?php endif;?>

			<?php endif;?>
					
					
		</p>
    </div>
  </div>
  	<input style="float:left;" type="button" class="btn ftm_back_button" value="Zurück" onClick="history.back();"></br>

</div>

    <?php if($canEdit): ?>
		<a class="btn" href="<?php echo JRoute::_('index.php?option=com_firefighters&task=mitglied.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_FIREFIGHTERS_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_firefighters.mitglied.'.$this->item->id)):?>
									<a class="btn" href="<?php echo JRoute::_('index.php?option=com_firefighters&task=mitglied.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_FIREFIGHTERS_DELETE_ITEM"); ?></a>
								<?php endif; ?>


<?php
else:
    echo JText::_('COM_FIREFIGHTERS_ITEM_NOT_LOADED');
endif;
?>



