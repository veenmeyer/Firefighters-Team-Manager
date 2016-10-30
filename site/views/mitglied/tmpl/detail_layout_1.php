<?php
/**
 * @version     1.0.0
 * @package     com_firefighters
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Ralf Meyer <ralf.meyer@mail.de> - http://einsatzkomponente.de
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

				<?php if ($this->item->bild) : ?>
				<div class="span2">
<a href="<?php echo JURI::Root().$this->item->bild;?>" rel="highslide[<?php echo $this->item->id; ?>]" class="highslide" onClick="return hs.expand(this, { captionText: '<?php echo $this->item->vorname.' '.$this->item->name;?>' });" alt ="<?php echo $this->item->vorname.' '.$this->item->name;?>">
                  <img class="" src="<?php echo JURI::Root().$this->item->bild;?>"  alt="<?php echo $this->item->vorname.' '.$this->item->name;?>" title="<?php echo $this->item->vorname.' '.$this->item->name;?>"/>
                  </a>
				</div>
				<?php endif;?>

<!--Titelbild mit Highslide JS  ENDE--> 


    <div class="span4">
      <blockquote>
        <p><?php echo $this->item->vorname.' '.$this->item->name; ?></p>
		<?php if ($this->item->dienstgrad) : ?>
        <small><cite title="Source Title"><?php echo $this->item->dienstgrad; ?>  <i class="icon-map-marker"></i></cite></small>
		<?php endif;?>
		
				<br/>	
					<?php if ($this->params->get('show_alter','1')) : ?>
					<?php if ($this->item->geburtsdatum != '0000-00-00 00:00:00') : ?>
					<?php echo 'Alter : '.floor((time() - strtotime($this->item->geburtsdatum)) / 31558149.540288); ?>
					<?php endif;?>
				<br/>
					<?php endif; ?>
					
					<?php if ($this->params->get('show_eintrittsdatum','1')) : ?>
					<?php if ($this->item->eintrittsdatum != '0000-00-00 00:00:00') : ?>
					<?php //echo 'Eintrittsjahr : '.date('Y', strtotime($item->eintrittsdatum)); ?>
					<?php echo 'Seit '.floor((time() - strtotime($this->item->eintrittsdatum)) / 31558149.540288).' Jahr(en) Mitglied in der Feuerwehr'; ?>
				<br/><br/>
					<?php endif; ?>
					<?php endif; ?>
					
		<p>
		<?php if ($this->item->funktion) : ?>
        <?php echo 'Funktion(-en) : '.$this->item->funktion; ?> <br>
		<?php endif;?>
		<?php if ($this->item->abteilungen) : ?>
        <?php echo 'Abteilung(-en) : '.$this->item->abteilungen; ?> <br>
		<?php endif;?>
		<?php if ($this->item->ausbildungen) : ?>
        <?php echo 'Ausbildung(-en) : '.$this->item->ausbildungen; ?>  <br>
		<?php endif;?>
		
		<?php if ($this->params->get('show_email','1')) : ?>
		<?php if ($this->item->emailadresse) : ?>
		<br>
        <?php echo 'Kontakt : <i class="icon-envelope"></i> '.JHTML::_('email.cloak', $this->item->emailadresse); ?> <br>
		<?php endif;?>
		<?php endif;?>

		</p>
    </div>
 </blockquote>
  </div>
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



