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

    <div class="item_fields">
        <table class="table">
            <tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_ID'); ?></th>
			<td><?php echo $this->item->id; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_NAME'); ?></th>
			<td><?php echo $this->item->name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_VORNAME'); ?></th>
			<td><?php echo $this->item->vorname; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_NAME_EIKO'); ?></th>
			<td><?php echo $this->item->name_eiko; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_BILD'); ?></th>
			<td><?php echo $this->item->bild; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_DIENSTGRAD'); ?></th>
			<td><?php echo $this->item->dienstgrad; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_ABTEILUNGEN'); ?></th>
			<td><?php echo $this->item->abteilungen; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_KOMMANDO'); ?></th>
			<td></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_FUNKTION'); ?></th>
			<td><?php echo $this->item->funktion; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_MEHR_FUNKTIONEN'); ?></th>
			<td><?php echo $this->item->mehr_funktionen; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_AUSBILDUNGEN'); ?></th>
			<td><?php echo $this->item->ausbildungen; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_GEBURTSDATUM'); ?></th>
			<td><?php echo $this->item->geburtsdatum; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_EINTRITTSDATUM'); ?></th>
			<td><?php echo $this->item->eintrittsdatum; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_AUSTRITTSDATUM'); ?></th>
			<td><?php echo $this->item->austrittsdatum; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_EMAILADRESSE'); ?></th>
			<td><?php echo $this->item->emailadresse; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_MISSIONS_EIKO'); ?></th>
			<td><?php echo $this->item->missions_eiko; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_MITGLIED_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>
<tr><td><input style="float:left;" type="button" class="btn ftm_back_button" value="Zurück" onClick="history.back();"></br>
</td><td></td>
        </table>
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
