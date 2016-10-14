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

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_firefighters', JPATH_ADMINISTRATOR);

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_firefighters.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_firefighters' . $this->item->id)) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ($this->item) : ?>

    <div class="item_fields">
        <table class="table">
            <tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_AUSBILDUNG_ID'); ?></th>
			<td><?php echo $this->item->id; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_AUSBILDUNG_NAME'); ?></th>
			<td><?php echo $this->item->name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_AUSBILDUNG_BILD'); ?></th>
			<td><?php echo $this->item->bild; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_AUSBILDUNG_BESCHREIBUNG'); ?></th>
			<td><?php echo $this->item->beschreibung; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_AUSBILDUNG_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_FIREFIGHTERS_FORM_LBL_AUSBILDUNG_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>

        </table>
    </div>
    <?php if($canEdit): ?>
		<a class="btn" href="<?php echo JRoute::_('index.php?option=com_firefighters&task=ausbildung.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_FIREFIGHTERS_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_firefighters.ausbildung.'.$this->item->id)):?>
									<a class="btn" href="<?php echo JRoute::_('index.php?option=com_firefighters&task=ausbildung.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_FIREFIGHTERS_DELETE_ITEM"); ?></a>
								<?php endif; ?>
    <?php
else:
    echo JText::_('COM_FIREFIGHTERS_ITEM_NOT_LOADED');
endif;
?>
