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
<!--Page Heading-->
<?php if ($this->params->get('show_page_heading', 1)) : ?>
<div class="page-header eiko_header_main">
<h1 class="ftm_header_h1"><?php echo $this->escape($this->params->get('page_heading')); ?> <span class="icon-info-2"> </span> <br/><small><?php echo $this->item->name; ?></small> </h1> 
</div>
<?php endif;?>


<?php if ($this->item) : ?>

    <div class="item_fields">
        <table class="table">
<tr>
			<td>
			<img class="img-rounded ftm_img_ausbildung_detail_1" style="float:right;margin-top:20px;margin-right:10px;margin-left:10px;width:250px;" src="<?php echo JURI::Root();?><?php echo $this->item->bild;?>" title="<?php echo $this->item->name;?>"/>
			<?php echo $this->item->beschreibung; ?>
			</td>
</tr>
<tr>
			<td>
			<input style="float:left;" type="button" class="btn eiko_back_button" value="Zurück" onClick="history.back();">
			</td>
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
