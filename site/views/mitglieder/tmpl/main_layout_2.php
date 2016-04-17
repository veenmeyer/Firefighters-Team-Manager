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

?>













<form action="<?php echo JRoute::_('index.php?option=com_firefighters&view=mitglieder'); ?>" method="post" name="adminForm" id="adminForm">


    <?php //echo JLayoutHelper::render('default_filter', array('view' => $this), dirname(__FILE__)); ?>
	
    <table class="table table-striped" id = "mitgliedList" >
        <thead >
            <tr >
			
				<?php if ($this->params->get('show_passbild','1')) : ?>
				<th class='left'>
				<?php echo 'Foto'; ?>
				</th>
				<?php endif;?>
				
				<?php if ($this->params->get('show_dienstgrad_image','1')) : ?>
				<th class='left'>
				</th>
				<?php endif;?>
				
    			<th class='left'>
				<?php echo 'Mitglied'; ?>
				</th>

    				<?php if ($canEdit || $canDelete): ?>
					<th class="center">
				<?php echo JText::_('COM_FIREFIGHTERS_MITGLIEDER_ACTIONS'); ?>
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


				<?php if ($this->params->get('show_passbild','1')) : ?>
				<td>
				<?php if ($item->bild) : ?>
					<img class="ftm_passbild" src="<?php echo JURI::Root();?><?php echo $item->bild;?>" alt="<?php echo $item->vorname.' '.$item->name;?>" title="<?php echo $item->vorname.' '.$item->name;?>"/>
				<?php endif;?>
				</td>
				<?php endif;?>
	
				<?php if ($this->params->get('show_dienstgrad_image','1')) : ?>
				<td>
				<?php if ($item->dienstgrad_image) : ?>
					<img class="ftm_dienstgrad_image img-circle" src="<?php echo JURI::Root();?><?php echo $item->dienstgrad_image;?>" alt="<?php echo $item->dienstgrad;?>" title="<?php echo $item->dienstgrad;?>"/>
				<?php endif;?>
				</td>
				<?php endif;?>
				
            	<td>
				<?php if (isset($item->checked_out) && $item->checked_out) : ?>
					<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'mitglieder.', $canCheckin); ?>
				<?php endif; ?>
				
				<?php if ($this->params->get('show_mitlgied_detail_link','1')) : ?>
				<a href="#aboutModal_<?php echo $item->id;?>" data-toggle="modal">
				<?php echo '<span style="font-size:20px;font-weight:bold;">'.$this->escape($item->name).', '.$this->escape($item->vorname).'</span>'; ?></a> 
				<?php endif; ?>
				<?php if (!$this->params->get('show_mitlgied_detail_link','1')) : ?>
				<?php echo '<span style="color:#d63b37;font-size:20px;font-weight:bold;">'.$this->escape($item->name).', '.$this->escape($item->vorname).'</span>'; ?>
				<?php endif; ?>
				
				<br/>				
					<?php if ($this->params->get('show_alter','1')) : ?>
					<?php if ($item->geburtsdatum != '0000-00-00 00:00:00') : ?>
					<?php echo '<b>Alter : </b>'.floor((time() - strtotime($item->geburtsdatum)) / 31558149.540288); ?>
				<br/>
					<?php endif; ?>
					<?php endif; ?>
					<?php if ($this->params->get('show_eintrittsdatum','1')) : ?>
					<?php if ($item->eintrittsdatum != '0000-00-00 00:00:00') : ?>
					<?php //echo '<b>Eintrittsjahr : </b>'.date('Y', strtotime($item->eintrittsdatum)); ?>
					<?php echo 'Seit '.floor((time() - strtotime($item->eintrittsdatum)) / 31558149.540288).' Jahr(en) Mitglied in der Feuerwehr'; ?>
				<br/><br/>
					<?php endif; ?>
					<?php endif; ?>
					
				
					<?php if ($item->funktion) : ?>
					<?php echo '<b>Funktion		: '.$item->funktion.'</b>'; ?><br/><br/>
					<?php endif; ?>
				
					<?php if ($item->dienstgrad) : ?>
					<?php echo '<b>Dienstgrad : </b>'.$item->dienstgrad; ?><br/>
					<?php endif; ?>

					<?php if ($item->abteilungen) : ?>
					<?php echo '<b>Abteilungen : </b>'.$item->abteilungen; ?><br/>
					<?php endif; ?>

					<?php if ($item->ausbildungen) : ?>
					<?php echo '<b>Ausbildung : </b>'.$item->ausbildungen; ?><br/>
					<?php endif; ?>
					
				
				
				</td>


            				<?php if ($canEdit || $canDelete): ?>
					<td class="center">
						<?php if ($canEdit): ?>
							<a href="<?php echo JRoute::_('index.php?option=com_firefighters&task=mitgliedform.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
						<?php endif; ?>
						<?php if ($canDelete): ?>
							<button data-item-id="<?php echo $item->id; ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></button>
						<?php endif; ?>
					</td>
				<?php endif; ?>

        </tr>
		
		
            <div class="modal hide" id="aboutModal_<?php echo $item->id;?>">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">x</button>
			        <h3>Ãœber <?php echo $this->escape($item->vorname).' '.$this->escape($item->name);?></h3>
			    </div>
			        <div class="modal-body" style="text-align:center;">
			        <div class="row-fluid">
			            <div class="span10 offset1">
			                <div id="modalTab">
			                    <div class="tab-content">
			                        <div class="tab-pane active" id="about">
										<img class="ftm_passbild img-circle" src="<?php echo JURI::Root();?><?php echo $item->bild;?>" alt="<?php echo $item->vorname.' '.$item->name;?>" title="<?php echo $item->vorname.' '.$item->name;?>"/>
      <h1 class="media-heading"><?php echo $this->escape($item->name).', '.$this->escape($item->vorname);?></br><small> <?php echo $item->dienstgrad;?></small></h1>
	  
					<!--<?php if ($this->params->get('show_alter','1')) : ?>-->
					<?php if ($item->geburtsdatum != '0000-00-00 00:00:00') : ?>
					<?php echo '<b>Alter : </b>'.floor((time() - strtotime($item->geburtsdatum)) / 31558149.540288); ?>
				<br/>
					<?php endif; ?>
					<!--<?php endif; ?>-->
					<!--<?php if ($this->params->get('show_eintrittsdatum','1')) : ?>-->
					<?php if ($item->eintrittsdatum != '0000-00-00 00:00:00') : ?>
					<?php //echo '<b>Eintrittsjahr : </b>'.date('Y', strtotime($item->eintrittsdatum)); ?>
					<?php echo 'Seit '.floor((time() - strtotime($item->eintrittsdatum)) / 31558149.540288).' Jahr(en) Mitglied in der Feuerwehr'; ?>
				<br/><br/>
					<?php endif; ?>
					<!--<?php endif; ?>-->
	  
					<?php if ($item->funktion) : ?>
                <span>
					<?php echo '<b>Funktion		: '.$item->funktion.'</b>'; ?><br/>
				</span>
					<?php endif; ?>
	  
				<?php if ($item->abteilungen) : ?>
                <span>
					<?php echo '<b>Abteilungen : </b>'.$item->abteilungen; ?><br/>
				</span>
					<?php endif; ?>
				<?php if ($item->ausbildungen) : ?>
				<span>
					<?php echo '<b>Ausbildungen : </b>'.$item->ausbildungen; ?><br/>
				</span>
					<?php endif; ?>
			
    </center>
    <hr>
      </div>
	</div>
</div>
</div>
</div>
</div>
</div>
		
		
		
    <?php endforeach; ?>
    </tbody>
    </table>

    <?php if ($canCreate): ?>
        <a href="<?php echo JRoute::_('index.php?option=com_firefighters&task=mitgliedform.edit&id=0', false, 2); ?>"
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
            window.location.href = '<?php echo JRoute::_('index.php?option=com_firefighters&task=mitgliedform.remove&id=', false, 2) ?>' + item_id;
        }
    }
</script>
