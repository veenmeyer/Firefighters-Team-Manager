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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canCreate = $user->authorise('core.create', 'com_firefighters');
$canEdit = $user->authorise('core.edit', 'com_firefighters');
$canCheckin = $user->authorise('core.manage', 'com_firefighters');
$canChange = $user->authorise('core.edit.state', 'com_firefighters');
$canDelete = $user->authorise('core.delete', 'com_firefighters');
?>

<!--Page Heading-->
<?php if ($this->params->get('show_page_heading', 1)) : ?>
<div class="page-header">
<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
</div>
<?php endif;?>

<form action="<?php echo JRoute::_('index.php?option=com_firefighters&view=termine'); ?>" method="post" name="adminForm" id="adminForm">

    <?php //echo JLayoutHelper::render('default_filter', array('view' => $this), dirname(__FILE__)); ?>
    <table class="table table-striped" id = "terminList" >
        <thead >
            <tr >

    				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'Ereignis', 'a.name', $listDirn, $listOrder); ?> 
				</th> 
				
				<?php if ($this->params->get('show_termine_image','1')) : ?>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_FIREFIGHTERS_TERMINE_BILD', 'a.bild', $listDirn, $listOrder); ?>
				</th>
				<?php endif; ?> 
				
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_FIREFIGHTERS_TERMINE_ABTEILUNGEN', 'a.abteilungen', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_FIREFIGHTERS_TERMINE_DATUM_START', 'a.datum_start', $listDirn, $listOrder); ?>
				</th>
				
				<?php if ($this->params->get('show_termine_ende','1')) : ?>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_FIREFIGHTERS_TERMINE_DATUM_ENDE', 'a.datum_ende', $listDirn, $listOrder); ?>
				</th>
				<?php endif; ?>


    				<?php if ($canEdit || $canDelete): ?>
					<th class="center">
				<?php echo JText::_('COM_FIREFIGHTERS_TERMINE_ACTIONS'); ?>
				</th>
				<?php endif; ?>

    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
            <?php echo $this->pagination->getListFooter(); ?>
        </td>
    </tr>
		<?php if (!$this->params->get('ftm')) : ?>
        <tr><!-- Bitte das Copyright nicht entfernen. Danke. -->
        <td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
			<span class="copyright">Firefighters Team Manager V<?php echo $this->version; ?>  (C) 2015 by Ralf Meyer ( <a class="copyright_link" href="http://einsatzkomponente.de" target="_blank">www.einsatzkomponente.de</a> )</span></td>
        </tr>
	<?php endif; ?>
    </tfoot>
    <tbody>
    <?php foreach ($this->items as $i => $item) : ?>
        <?php $canEdit = $user->authorise('core.edit', 'com_firefighters'); ?>

        				<?php if (!$canEdit && $user->authorise('core.edit.own', 'com_firefighters')): ?>
					<?php $canEdit = JFactory::getUser()->id == $item->created_by; ?>
				<?php endif; ?>

        <tr class="row<?php echo $i % 2; ?>">


            				<td>
				<?php if (isset($item->checked_out) && $item->checked_out) : ?>
					<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'termine.', $canCheckin); ?>
				<?php endif; ?>
				
				<?php if ($this->params->get('show_link_termin','1')) : ?>
				<a href="<?php echo JRoute::_('index.php?option=com_firefighters&view=termin&id='.(int) $item->id); ?>">
				<?php echo $this->escape($item->name); ?></a>
				<?php else: ?>
				<?php echo $this->escape($item->name); ?>
				<?php endif; ?>
				</td>
				
				<?php if ($this->params->get('show_termine_image','1')) : ?>
				<td>
				<?php if ($item->bild) : ?>
					<img class="ftm_termine_image" src="<?php echo JURI::Root();?><?php echo $item->bild;?>" alt="<?php echo $item->bild;?>" title="<?php echo $item->name;?>"/>
				<?php endif;?>
				</td>
				<?php endif; ?>
				
				<td>
					<?php echo $item->abteilungen; ?>
				</td>
    	<td>
			<?php echo '<span style="white-space:nowrap">'.date('<b>d.m.Y</b> @ H:i', strtotime($item->datum_start)).' Uhr</span>';  ?>
    	</td>
			
		<?php if ($this->params->get('show_termine_ende','1')) : ?>
    	<td>
		<?php if ($item->datum_ende != "0000-00-00 00:00:00"): echo date('<b>d.m.Y</b> @ H:i', strtotime($item->datum_ende)).' Uhr'; endif;  ?>
    	</td>
				<?php endif; ?>

				
            				<?php if ($canEdit || $canDelete): ?>
					<td class="center">
						<?php if ($canEdit): ?>
							<a href="<?php echo JRoute::_('index.php?option=com_firefighters&task=terminform.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
						<?php endif; ?>
						<?php if ($canDelete): ?>
							<button data-item-id="<?php echo $item->id; ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></button>
						<?php endif; ?>
					</td>
				<?php endif; ?>

        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>

    <?php if ($canCreate): ?>
        <a href="<?php echo JRoute::_('index.php?option=com_firefighters&task=terminform.edit&id=0', false, 2); ?>"
           class="btn btn-success btn-small"><i
                class="icon-plus"></i> <?php echo JText::_('COM_FIREFIGHTERS_ADD_ITEM'); ?></a>
    <?php endif; ?>

    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
    <?php echo JHtml::_('form.token'); ?>
</form>

<script type="text/javascript">

    jQuery(document).ready(function () {
        jQuery('.delete-button').click(deleteItem);
    });

    function deleteItem() {
        var item_id = jQuery(this).attr('data-item-id');
        if (confirm("<?php echo JText::_('COM_FIREFIGHTERS_DELETE_MESSAGE'); ?>")) {
            window.location.href = '<?php echo JRoute::_('index.php?option=com_firefighters&task=terminform.remove&id=', false, 2) ?>' + item_id;
        }
    }
</script>

