<?php
/**
 * @version     1.0.0
 * @package     com_firefighters
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder sp�ter; siehe LICENSE.txt
 * @author      Ralf Meyer <ralf.meyer@mail.de> - http://einsatzkomponente.de
 */
// no direct access
defined('_JEXEC') or die;

?>


<form action="<?php echo JRoute::_('index.php?option=com_firefighters&view=termine'); ?>" method="post" name="adminForm" id="adminForm">

    <?php //echo JLayoutHelper::render('default_filter', array('view' => $this), dirname(__FILE__)); ?>



   <div class="container">
		<div class="row">
			<div class="[ col-xs-12 col-sm-offset-2 col-sm-8 ]">
				<ul class="event-list">
				
				    <?php foreach ($this->items as $i => $item) : ?>

					<li>
			<?php 	
						  $curDate = strtotime($item->datum_start); 
						  $curTime = date('H:i', $curDate);
			?>
						<time datetime="<?php echo date('<b>d.m.Y</b> ', $curDate);?>">
					<!--		<span class="Tag"><?php echo date('D', $curDate);?></span>
							<span class="day"><?php echo date('d', $curDate);?></span>
							<span class="month"><?php echo date('m', $curDate);?></span>
							<span class="year"><?php echo date('Y', $curDate);?></span>  -->
							<span class="ftm_termine_datum_start"><?php echo date('d.m.Y', $curDate);?></span>
						  <?php if ($curTime != '00:00') : ?>
							<span class="time"><?php echo'@ '.date('H:i ', $curDate).' Uhr';?></span>
						  <?php endif;?>
						  
					<?php if ($this->params->get('show_termine_image','1')) : ?>
					<?php if ($item->bild) : ?>
						<img class="ftm_termine_image" src="<?php echo JURI::Root();?><?php echo $item->bild;?>" alt="<?php echo $item->bild;?>" title="<?php echo $item->name;?>"/>
					<?php endif;?>
					<?php endif;?>
						  
						  
						</time>
						

						<div class="info">
							<?php if ($this->params->get('show_link_termin','1')) : ?>
							<a href="<?php echo JRoute::_('index.php?option=com_firefighters&view=termin&id='.(int) $item->id); ?>">
							<?php echo '<p class="ftm_termine_title">'.$this->escape($item->name).'</p>'; ?></a>
							<?php else: ?>
							<?php echo '<p class="ftm_termine_title">'.$this->escape($item->name).'</p>'; ?>
							<?php endif; ?>
							
							<?php if ($item->abteilungen) : ?>
							<?php echo '<p class="ftm_termine_abt">'.$item->abteilungen.'</p>'; ?>
							<?php else:?>
							<?php echo '<p class="ftm_termine_abt"></p>'; ?>
							<?php endif;?>
							
							<?php if ($item->beschreibung) : ?>
							<?php echo '<p class="ftm_termine_desc">'.$item->beschreibung.'</p>'; ?>
							<?php endif;?>
						</div>
						
						 <?php if ($canEdit || $canDelete): ?>
						<div class="social">
							<ul>
								<li class="facebook" style="width:33%;">
								<?php if ($canEdit): ?>
									<a href="<?php echo JRoute::_('index.php?option=com_firefighters&task=terminform.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
								<?php endif; ?>
								</li>
								<li class="twitter" style="width:34%;">
								<?php if ($canDelete): ?>
									<button data-item-id="<?php echo $item->id; ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></button>
								<?php endif; ?>
								</li>
							</ul>
						</div>
						<?php endif;?>
						
					</li>
    <?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>





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
    <tfoot>
    <tr>
        <td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
            <?php echo $this->pagination->getListFooter(); ?>
        </td>
    </tr>
		<?php if (!$this->params->get('ftm')) : ?>
        <tr><!-- Bitte das Copyright nicht entfernen. Danke. -->
        <td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
			<span class="copyright">Firefighters Team Manager V<?php echo $this->version; ?>  (C) 2016 by Ralf Meyer ( <a class="copyright_link" href="http://einsatzkomponente.de" target="_blank">www.einsatzkomponente.de</a> )</span></td>
        </tr>
	<?php endif; ?>
    </tfoot>

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


