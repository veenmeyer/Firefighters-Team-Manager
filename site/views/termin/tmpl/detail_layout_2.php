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

    <div class="item_fields">
        <table class="table">
            <tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_ID'); ?></th>
			<td><?php echo $this->item->id; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_NAME'); ?></th>
			<td><?php echo $this->item->name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_BILD'); ?></th>
			<td><?php echo $this->item->bild; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_EMAIL'); ?></th>
			<td></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_ABTEILUNGEN'); ?></th>
			<td><?php echo $this->item->abteilungen; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_BESCHREIBUNG'); ?></th>
			<td><?php echo $this->item->beschreibung; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_DATUM_START'); ?></th>
			<td><?php echo $this->item->datum_start; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_DATUM_ENDE'); ?></th>
			<td><?php echo $this->item->datum_ende; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_EMAIL_GESENDET'); ?></th>
			<td><?php echo $this->item->email_gesendet; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>
<tr>
			<td></td>
			<td>
  <?php 
		// Get active menu
		$app	= JFactory::getApplication();
		$menus	= $app->getMenu();
		$this->menu = $menus->getActive();
		$itemID = '&Itemid='.$this->menu->id.'&list=1';
		if (!$this->menu->id) {
			if ($this->params->get('terminelink','')) :
			$itemID = '&Itemid='.$this->params->get('terminelink','').'&list=1';
			endif;
		}
  echo '<a href="'.JRoute::_('index.php?option=com_firefighters&view=termine'.$itemID.'').'" class="btn"><strong>'.JText::_('Übersicht').'</strong></a></br>';
  ?>
  	<!--<input style="float:left;" type="button" class="btn ftm_back_button" value="Zurück" onClick="history.back();">-->
			</td>
</tr>
        </table>
    </div>
    <?php if($canEdit): ?>
		<a class="btn" href="<?php echo JRoute::_('index.php?option=com_firefighters&task=termin.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_FIREFIGHTERS_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_firefighters.termin.'.$this->item->id)):?>
									<a class="btn" href="<?php echo JRoute::_('index.php?option=com_firefighters&task=termin.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_FIREFIGHTERS_DELETE_ITEM"); ?></a>
								<?php endif; ?>
    <?php
else:
    echo JText::_('COM_FIREFIGHTERS_ITEM_NOT_LOADED');
endif;
?>
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

    <div class="item_fields">
        <table class="table">
            <tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_ID'); ?></th>
			<td><?php echo $this->item->id; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_NAME'); ?></th>
			<td><?php echo $this->item->name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_BILD'); ?></th>
			<td><?php echo $this->item->bild; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_EMAIL'); ?></th>
			<td></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_ABTEILUNGEN'); ?></th>
			<td><?php echo $this->item->abteilungen; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_BESCHREIBUNG'); ?></th>
			<td><?php echo $this->item->beschreibung; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_DATUM_START'); ?></th>
			<td><?php echo $this->item->datum_start; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_DATUM_ENDE'); ?></th>
			<td><?php echo $this->item->datum_ende; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_EMAIL_GESENDET'); ?></th>
			<td><?php echo $this->item->email_gesendet; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_TERMIN_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>

        </table>
    </div>
    <?php if($canEdit): ?>
		<a class="btn" href="<?php echo JRoute::_('index.php?option=com_firefighters&task=termin.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_FIREFIGHTERS_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_firefighters.termin.'.$this->item->id)):?>
									<a class="btn" href="<?php echo JRoute::_('index.php?option=com_firefighters&task=termin.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_FIREFIGHTERS_DELETE_ITEM"); ?></a>
								<?php endif; ?>
    <?php
else:
    echo JText::_('COM_FIREFIGHTERS_ITEM_NOT_LOADED');
endif;
?>
